<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            if (!Schema::hasColumn('trainers', 'stripe_account_id')) {
                $table->string('stripe_account_id')->nullable()->after('delivery_modes');
            }
            if (!Schema::hasColumn('trainers', 'stripe_connect_status')) {
                $table->string('stripe_connect_status')->default('not_connected')->after('stripe_account_id');
            }
            if (!Schema::hasColumn('trainers', 'stripe_country')) {
                $table->string('stripe_country', 2)->nullable()->after('stripe_connect_status');
            }
            if (!Schema::hasColumn('trainers', 'stripe_charges_enabled')) {
                $table->boolean('stripe_charges_enabled')->default(false)->after('stripe_country');
            }
            if (!Schema::hasColumn('trainers', 'stripe_payouts_enabled')) {
                $table->boolean('stripe_payouts_enabled')->default(false)->after('stripe_charges_enabled');
            }
            if (!Schema::hasColumn('trainers', 'stripe_details_submitted')) {
                $table->boolean('stripe_details_submitted')->default(false)->after('stripe_payouts_enabled');
            }
            if (!Schema::hasColumn('trainers', 'stripe_connected_at')) {
                $table->timestamp('stripe_connected_at')->nullable()->after('stripe_details_submitted');
            }
        });

        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'stripe_payment_intent_id')) {
                $table->string('stripe_payment_intent_id')->nullable()->after('stripe_session_id');
            }
            if (!Schema::hasColumn('appointments', 'stripe_charge_id')) {
                $table->string('stripe_charge_id')->nullable()->after('stripe_payment_intent_id');
            }
            if (!Schema::hasColumn('appointments', 'stripe_transfer_id')) {
                $table->string('stripe_transfer_id')->nullable()->after('stripe_charge_id');
            }
            if (!Schema::hasColumn('appointments', 'platform_commission_percent')) {
                $table->decimal('platform_commission_percent', 5, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('appointments', 'platform_commission_amount')) {
                $table->decimal('platform_commission_amount', 10, 2)->nullable()->after('platform_commission_percent');
            }
            if (!Schema::hasColumn('appointments', 'stripe_fee_amount')) {
                $table->decimal('stripe_fee_amount', 10, 2)->nullable()->after('platform_commission_amount');
            }
            if (!Schema::hasColumn('appointments', 'trainer_payout_amount')) {
                $table->decimal('trainer_payout_amount', 10, 2)->nullable()->after('stripe_fee_amount');
            }
            if (!Schema::hasColumn('appointments', 'payout_status')) {
                $table->string('payout_status')->default('not_applicable')->after('trainer_payout_amount');
            }
            if (!Schema::hasColumn('appointments', 'payout_released_at')) {
                $table->timestamp('payout_released_at')->nullable()->after('payout_status');
            }
            if (!Schema::hasColumn('appointments', 'payout_error')) {
                $table->text('payout_error')->nullable()->after('payout_released_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            foreach ([
                'stripe_account_id',
                'stripe_connect_status',
                'stripe_country',
                'stripe_charges_enabled',
                'stripe_payouts_enabled',
                'stripe_details_submitted',
                'stripe_connected_at',
            ] as $column) {
                if (Schema::hasColumn('trainers', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('appointments', function (Blueprint $table) {
            foreach ([
                'stripe_payment_intent_id',
                'stripe_charge_id',
                'stripe_transfer_id',
                'platform_commission_percent',
                'platform_commission_amount',
                'stripe_fee_amount',
                'trainer_payout_amount',
                'payout_status',
                'payout_released_at',
                'payout_error',
            ] as $column) {
                if (Schema::hasColumn('appointments', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
