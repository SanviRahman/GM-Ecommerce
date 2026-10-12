<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OrderProducts;
use App\Purchase;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class StockController extends Controller
{
    public function index()
    {
        return view('admin.stock.index');
    }

    public function show($id)
    {
        return [
            'data' => DB::table('stocks')
                ->join('products', 'stocks.product_id', '=', 'products.id')
                ->select('stocks.id', 'stocks.product_id', 'stocks.purchase', 'stocks.stock', 'products.productName')
                ->orderByDesc('stocks.created_at')->get(),
        ];
    }

    public function edit($id)
    {
        return response()->json(Stock::findOrFail($id));
    }

    /** Adjust available stock without overwriting the historical purchase total. */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'operation' => 'required|in:add,subtract,set',
            'quantity' => 'required|integer|min:0|max:1000000',
        ]);
        try {
            DB::transaction(function () use ($id, $data) {
                $stock = Stock::whereKey($id)->lockForUpdate()->firstOrFail();
                $old = (int) $stock->stock;
                $amount = (int) $data['quantity'];
                $new = $data['operation'] === 'add' ? $old + $amount
                    : ($data['operation'] === 'subtract' ? $old - $amount : $amount);
                if ($new < 0 || $new > 100000000) {
                    throw new RuntimeException('Available Stock must remain between 0 and 100,000,000.');
                }
                $stock->stock = $new;
                $stock->save();
                Log::info('Admin inventory adjustment', [
                    'user_id' => auth()->id(), 'stock_id' => $stock->id,
                    'product_id' => $stock->product_id, 'old' => $old, 'new' => $new,
                    'operation' => $data['operation'],
                ]);
            }, 3);
            return redirect()->route('admin.stock.index')->with('success', 'Available stock updated.');
        } catch (RuntimeException $e) {
            return redirect()->route('admin.stock.index')->with('error', $e->getMessage());
        }
    }

    /** Destructive delete prohibited for product rows with history or remaining quantity. */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $stock = Stock::whereKey($id)->lockForUpdate()->firstOrFail();
                if ((int) $stock->stock !== 0 || (int) $stock->purchase !== 0
                    || Purchase::where('product_id', $stock->product_id)->exists()
                    || OrderProducts::where('product_id', $stock->product_id)->exists()) {
                    throw new RuntimeException('Cannot delete stock with available quantity or purchase/order history. Use Edit to adjust stock.');
                }
                Log::warning('Admin deleted empty inventory row', [
                    'user_id' => auth()->id(), 'stock_id' => $stock->id, 'product_id' => $stock->product_id,
                ]);
                $stock->delete();
            }, 3);
            return response()->json(['status' => 'success', 'message' => 'Unused stock record deleted.']);
        } catch (RuntimeException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }
}
