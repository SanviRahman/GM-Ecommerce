<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnsureShippingChargesTable extends Migration
{
    /**
     * Create shipping_charges table when it does not already exist.
     *
     * Existing production table/data will remain untouched.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('shipping_charges')) {
            return;
        }

        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('charge', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Keep rollback non-destructive for legacy production compatibility.
     *
     * @return void
     */
    public function down()
    {
        // Intentionally non-destructive.
    }
}