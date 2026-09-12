<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnsureSectionsTable extends Migration
{
    /**
     * Ensure the legacy sections table exists for fresh/local installs.
     * Existing production tables/data are left untouched.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('sections')) {
            return;
        }

        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedInteger('max')->default(0);
            $table->unsignedInteger('sort')->default(0)->index();
            $table->string('status')->default('Active')->index();
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
