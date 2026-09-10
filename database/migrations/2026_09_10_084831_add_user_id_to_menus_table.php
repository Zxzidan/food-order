<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->cascadeOnDelete();
        });

        // Alokasikan menu yang sudah ada sebelumnya ke user pemilik pesanan eksisting (User 5 atau user pertama)
        $defaultUserId = DB::table('users')->where('id', 5)->value('id') ?? DB::table('users')->value('id');
        if ($defaultUserId) {
            DB::table('menus')->whereNull('user_id')->update(['user_id' => $defaultUserId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
