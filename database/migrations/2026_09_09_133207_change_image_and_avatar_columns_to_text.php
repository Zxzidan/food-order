<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            if (Schema::hasTable('menus') && Schema::hasColumn('menus', 'image')) {
                DB::statement('ALTER TABLE menus ALTER COLUMN image TYPE TEXT;');
            }

            if (Schema::hasTable('users') && Schema::hasColumn('users', 'avatar')) {
                DB::statement('ALTER TABLE users ALTER COLUMN avatar TYPE TEXT;');
            }
        } elseif ($driver === 'mysql') {
            if (Schema::hasTable('menus') && Schema::hasColumn('menus', 'image')) {
                DB::statement('ALTER TABLE menus MODIFY image LONGTEXT;');
            }

            if (Schema::hasTable('users') && Schema::hasColumn('users', 'avatar')) {
                DB::statement('ALTER TABLE users MODIFY avatar LONGTEXT;');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            if (Schema::hasTable('menus') && Schema::hasColumn('menus', 'image')) {
                DB::statement('ALTER TABLE menus ALTER COLUMN image TYPE VARCHAR(255);');
            }

            if (Schema::hasTable('users') && Schema::hasColumn('users', 'avatar')) {
                DB::statement('ALTER TABLE users ALTER COLUMN avatar TYPE VARCHAR(255);');
            }
        } elseif ($driver === 'mysql') {
            if (Schema::hasTable('menus') && Schema::hasColumn('menus', 'image')) {
                DB::statement('ALTER TABLE menus MODIFY image VARCHAR(255);');
            }

            if (Schema::hasTable('users') && Schema::hasColumn('users', 'avatar')) {
                DB::statement('ALTER TABLE users MODIFY avatar VARCHAR(255);');
            }
        }
    }
};
