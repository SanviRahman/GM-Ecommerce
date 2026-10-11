<?php

namespace App\Services;

use App\Order;
use App\OrderProducts;
use App\Stock;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * Stock is allocated when a frontend order is confirmed, not when the cart is filled.
 * Call inside DB::transaction(). Uses row locks for concurrent checkouts.
 */
class OrderStockService
{
    public function reserve(Order $order): void
    {
        $lockedOrder = Order::whereKey($order->id)->lockForUpdate()->firstOrFail();
        if ((bool) $lockedOrder->stock_deducted) {
            return;
        }

        $quantities = $this->quantities($lockedOrder);
        if (!$quantities) {
            throw new RuntimeException('Cannot reserve stock for an empty order.');
        }

        // Always acquire stock locks in product-id order to reduce deadlocks.
        foreach ($quantities as $productId => $quantity) {
            $stock = Stock::where('product_id', $productId)->lockForUpdate()->first();
            if (!$stock || (int) $stock->stock < $quantity) {
                throw new RuntimeException('Insufficient stock for product ID ' . $productId . '. Please update your cart.');
            }
            $stock->stock = (int) $stock->stock - $quantity;
            $stock->save();
        }

        $lockedOrder->stock_deducted = true;
        $lockedOrder->save();
        $order->stock_deducted = true;
    }

    public function release(Order $order): void
    {
        $lockedOrder = Order::whereKey($order->id)->lockForUpdate()->firstOrFail();
        if (!(bool) $lockedOrder->stock_deducted) {
            return;
        }

        foreach ($this->quantities($lockedOrder) as $productId => $quantity) {
            $stock = Stock::where('product_id', $productId)->lockForUpdate()->first();
            if (!$stock) {
                throw new RuntimeException('Missing inventory row for product ID ' . $productId . '.');
            }
            $stock->stock = (int) $stock->stock + $quantity;
            $stock->save();
        }

        $lockedOrder->stock_deducted = false;
        $lockedOrder->save();
        $order->stock_deducted = false;
    }

    /** Prevent double deductions when Admin/Manager/User changes status. */
    public function onStatusChange(Order $order, string $newStatus): void
    {
        if (in_array($newStatus, ['Canceled', 'Cancelled', 'Return'], true)) {
            $this->release($order);
            return;
        }

        // Old admin-created orders allocated stock at Delivered; retain that support.
        // Reactivated canceled/returned orders need new allocation.
        if ($newStatus === 'Delivered' || in_array($order->status, ['Canceled', 'Cancelled', 'Return'], true)) {
            $this->reserve($order);
        }
    }

    private function quantities(Order $order): array
    {
        $rows = OrderProducts::where('order_id', $order->id)
            ->selectRaw('product_id, SUM(quantity) as total_quantity')
            ->groupBy('product_id')
            ->orderBy('product_id')
            ->get();
        $quantities = [];
        foreach ($rows as $row) {
            $qty = (int) $row->total_quantity;
            if ($qty <= 0) {
                throw new RuntimeException('Invalid ordered quantity for product ID ' . $row->product_id . '.');
            }
            $quantities[(int) $row->product_id] = $qty;
        }
        return $quantities;
    }
}
