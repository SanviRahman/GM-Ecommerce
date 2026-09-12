<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnsureOptionsAndOptionProductTables extends Migration
{
    /**
     * Ensure the legacy option infrastructure exists on fresh/local databases.
     * Production-safe: existing tables are preserved and only missing columns
     * required by the current application are added.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('options')) {
            Schema::create('options', function (Blueprint $table) {
                $table->id();
                $table->string('optionName');
                $table->string('status')->default('Active');
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('options', 'optionName')) {
                Schema::table('options', function (Blueprint $table) {
                    $table->string('optionName')->nullable();
                });
            }

            if (!Schema::hasColumn('options', 'status')) {
                Schema::table('options', function (Blueprint $table) {
                    $table->string('status')->default('Active');
                });
            }

            if (!Schema::hasColumn('options', 'created_at')) {
                Schema::table('options', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable();
                });
            }

            if (!Schema::hasColumn('options', 'updated_at')) {
                Schema::table('options', function (Blueprint $table) {
                    $table->timestamp('updated_at')->nullable();
                });
            }
        }

        if (!Schema::hasTable('option_product')) {
            Schema::create('option_product', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('option_id');
                $table->decimal('price', 12, 2)->nullable();
                $table->timestamps();

                $table->unique(['product_id', 'option_id'], 'option_product_unique');
                $table->index('option_id', 'option_product_option_idx');
            });
        } else {
            if (!Schema::hasColumn('option_product', 'price')) {
                Schema::table('option_product', function (Blueprint $table) {
                    $table->decimal('price', 12, 2)->nullable();
                });
            }

            if (!Schema::hasColumn('option_product', 'created_at')) {
                Schema::table('option_product', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable();
                });
            }

            if (!Schema::hasColumn('option_product', 'updated_at')) {
                Schema::table('option_product', function (Blueprint $table) {
                    $table->timestamp('updated_at')->nullable();
                });
            }
        }
    }

    /**
     * Intentionally non-destructive because these tables may pre-date the
     * migration history on the production database.
     *
     * @return void
     */
    public function down()
    {
        // No destructive rollback by design.
    }
}
