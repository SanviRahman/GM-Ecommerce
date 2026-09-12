<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnsureSizesColorsAndProductAttributePivots extends Migration
{
    /**
     * Restore legacy size/color tables that exist on the live database but
     * are missing from this project's migration history. Existing production
     * tables are preserved; only missing structures are created/extended.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sizes')) {
            Schema::create('sizes', function (Blueprint $table) {
                $table->id();
                $table->string('sizeName');
                $table->string('status')->default('Active');
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('sizes', 'sizeName')) {
                Schema::table('sizes', function (Blueprint $table) {
                    $table->string('sizeName')->nullable();
                });
            }

            if (!Schema::hasColumn('sizes', 'status')) {
                Schema::table('sizes', function (Blueprint $table) {
                    $table->string('status')->default('Active');
                });
            }

            if (!Schema::hasColumn('sizes', 'created_at')) {
                Schema::table('sizes', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable();
                });
            }

            if (!Schema::hasColumn('sizes', 'updated_at')) {
                Schema::table('sizes', function (Blueprint $table) {
                    $table->timestamp('updated_at')->nullable();
                });
            }
        }

        if (!Schema::hasTable('colors')) {
            Schema::create('colors', function (Blueprint $table) {
                $table->id();
                $table->string('colorName');
                $table->string('colorCode')->nullable();
                $table->string('status')->default('Active');
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('colors', 'colorName')) {
                Schema::table('colors', function (Blueprint $table) {
                    $table->string('colorName')->nullable();
                });
            }

            if (!Schema::hasColumn('colors', 'colorCode')) {
                Schema::table('colors', function (Blueprint $table) {
                    $table->string('colorCode')->nullable();
                });
            }

            if (!Schema::hasColumn('colors', 'status')) {
                Schema::table('colors', function (Blueprint $table) {
                    $table->string('status')->default('Active');
                });
            }

            if (!Schema::hasColumn('colors', 'created_at')) {
                Schema::table('colors', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable();
                });
            }

            if (!Schema::hasColumn('colors', 'updated_at')) {
                Schema::table('colors', function (Blueprint $table) {
                    $table->timestamp('updated_at')->nullable();
                });
            }
        }

        if (!Schema::hasTable('product_size')) {
            Schema::create('product_size', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('size_id');
                $table->timestamps();

                $table->index('product_id', 'product_size_product_idx');
                $table->index('size_id', 'product_size_size_idx');
            });
        }

        // Product::colors() follows Laravel's conventional color_product name.
        if (!Schema::hasTable('color_product')) {
            Schema::create('color_product', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('color_id');
                $table->unsignedBigInteger('product_id');
                $table->timestamps();

                $table->index('color_id', 'color_product_color_idx');
                $table->index('product_id', 'color_product_product_idx');
            });
        }
    }

    /**
     * Intentionally non-destructive because the live database may already
     * contain legacy size/color data outside Laravel's migration history.
     *
     * @return void
     */
    public function down()
    {
        // No destructive rollback by design.
    }
}
