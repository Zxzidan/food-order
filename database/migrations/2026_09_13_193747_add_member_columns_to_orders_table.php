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
            $table->foreignId('member_id')->nullable()->after('user_id')->constrained('members')->nullOnDelete();
            $table->unsignedInteger('points_used')->default(0)->after('discount');
            $table->unsignedBigInteger('points_discount_amount')->default(0)->after('points_used');
            $table->unsignedInteger('points_earned')->default(0)->after('points_discount_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropColumn(['member_id', 'points_used', 'points_discount_amount', 'points_earned']);
        });
    }
};
