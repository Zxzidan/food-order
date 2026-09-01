<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Change enum to string for flexibility
            $table->string('payment_status', 50)->default('pending')->change();
            $table->string('payment_method', 50)->nullable()->change();

            // Add new midtrans columns
            $table->string('midtrans_payment_type', 50)->nullable()->after('payment_method');
            $table->timestamp('midtrans_transaction_time')->nullable()->after('midtrans_status');
            $table->timestamp('midtrans_settlement_time')->nullable()->after('midtrans_transaction_time');

            // Add index for faster webhook lookup
            $table->index('midtrans_transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['midtrans_transaction_id']);
            $table->dropColumn(['midtrans_payment_type', 'midtrans_transaction_time', 'midtrans_settlement_time']);
        });
    }
};
