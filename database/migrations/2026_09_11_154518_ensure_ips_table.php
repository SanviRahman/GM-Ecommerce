<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnsureIpsTable extends Migration
{
    /**
     * Ensure the legacy ips table exists for fresh/local installs.
     * Existing production tables/data are left untouched.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('ips')) {
            return;
        }

        Schema::create('ips', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->index();
            $table->timestamps();
        });
    }

    /**
     * Non-destructive rollback for legacy production compatibility.
     *
     * @return void
     */
    public function down()
    {
        // Intentionally non-destructive.
    }
}
