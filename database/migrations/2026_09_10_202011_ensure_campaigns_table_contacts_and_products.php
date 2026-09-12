<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EnsureCampaignsTableContactsAndProducts extends Migration
{
    /**
     * Ensure the legacy campaigns table exists, add campaign-specific contact
     * fields, and add an ordered many-to-many campaign/product relation.
     *
     * This is safe for the existing production database where campaigns may
     * already exist without an original migration file.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('campaigns')) {
            Schema::create('campaigns', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('banner_title');
                $table->string('video')->nullable();
                $table->string('banner');
                $table->string('slug')->unique();
                $table->text('short_description');
                $table->longText('description');
                $table->unsignedBigInteger('product_id')->nullable()->index();
                $table->string('phone_number', 30)->nullable();
                $table->string('whatsapp_number', 30)->nullable();
                $table->string('image_one')->nullable();
                $table->string('image_two')->nullable();
                $table->string('image_three')->nullable();
                $table->boolean('status')->default(true);
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('campaigns', 'phone_number')) {
                Schema::table('campaigns', function (Blueprint $table) {
                    $table->string('phone_number', 30)->nullable();
                });
            }

            if (!Schema::hasColumn('campaigns', 'whatsapp_number')) {
                Schema::table('campaigns', function (Blueprint $table) {
                    $table->string('whatsapp_number', 30)->nullable();
                });
            }
        }

        if (!Schema::hasTable('campaign_product')) {
            Schema::create('campaign_product', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('campaign_id');
                $table->unsignedBigInteger('product_id');
                $table->unsignedInteger('position')->default(1);
                $table->timestamps();

                $table->unique(['campaign_id', 'product_id'], 'campaign_product_unique');
                $table->index(['campaign_id', 'position'], 'campaign_product_position_idx');
                $table->index('product_id', 'campaign_product_product_idx');
            });
        }

        // Preserve all existing single-product campaigns as Product 1.
        if (Schema::hasColumn('campaigns', 'product_id')) {
            $campaigns = DB::table('campaigns')
                ->select('id', 'product_id')
                ->whereNotNull('product_id')
                ->orderBy('id')
                ->get();

            foreach ($campaigns as $campaign) {
                $exists = DB::table('campaign_product')
                    ->where('campaign_id', $campaign->id)
                    ->where('product_id', $campaign->product_id)
                    ->exists();

                if (!$exists) {
                    DB::table('campaign_product')->insert([
                        'campaign_id' => $campaign->id,
                        'product_id' => $campaign->product_id,
                        'position' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Intentionally non-destructive. The production campaigns table is a
     * legacy table and may pre-date migrations, so rollback must never delete
     * existing campaign/contact/product data automatically.
     *
     * @return void
     */
    public function down()
    {
        // No destructive rollback by design.
    }
}
