<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddStockDeductedToOrdersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('orders', 'stock_deducted')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->boolean('stock_deducted')->default(false);
            });
        }

        // Legacy workflow already deducted inventory on Delivered.
        // Mark historic delivered orders to prevent a second deduction.
        DB::table('orders')->whereIn('status', [
            'Delivered', 'Customer Confirm', 'Customer On Hold', 'Request to Return',
        ])->update(['stock_deducted' => 1]);
    }

    public function down()
    {
        if (Schema::hasColumn('orders', 'stock_deducted')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('stock_deducted');
            });
        }
    }
}
