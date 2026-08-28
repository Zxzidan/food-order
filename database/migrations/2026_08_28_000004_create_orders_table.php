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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->index();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('customer_name')->default('Umum');
            $table->enum('order_type', ['Dine In', 'Take Away'])->default('Dine In');
            $table->string('table_number')->nullable();
            $table->unsignedBigInteger('subtotal')->default(0);
            $table->unsignedBigInteger('tax')->default(0);
            $table->unsignedBigInteger('discount')->default(0);
            $table->unsignedBigInteger('total_amount')->default(0);
            $table->enum('payment_method', ['Tunai', 'QRIS', 'Debit', 'Transfer'])->default('Tunai');
            $table->enum('payment_status', ['Lunas', 'Belum Lunas', 'Batal'])->default('Lunas');
            $table->unsignedBigInteger('cash_received')->nullable();
            $table->unsignedBigInteger('change_amount')->nullable();
            $table->enum('status', ['Selesai', 'Diproses', 'Dibatalkan'])->default('Selesai');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
