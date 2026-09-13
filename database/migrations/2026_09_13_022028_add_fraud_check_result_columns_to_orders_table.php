<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFraudCheckResultColumnsToOrdersTable extends Migration
{
    /**
     * Store the latest successful fraud-check summary for each order so the
     * result remains visible after refresh/login. Existing order data is kept.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            return;
        }

        if (!Schema::hasColumn('orders', 'fraud_success_count')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedInteger('fraud_success_count')->nullable();
            });
        }

        if (!Schema::hasColumn('orders', 'fraud_fail_count')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedInteger('fraud_fail_count')->nullable();
            });
        }
    }

    /**
     * Intentionally non-destructive: a production rollback must not erase
     * saved fraud-check history automatically.
     *
     * @return void
     */
    public function down()
    {
        // No destructive rollback by design.
    }
}
