<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan 'user' ke enum role dan set default 'user'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','user','courier','customer','owner') NOT NULL DEFAULT 'user'");

        // Tambah kolom jika tidak ada, atau ubah jika sudah ada
        if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'alamat')) {
            DB::statement("ALTER TABLE users ADD COLUMN alamat TEXT NULL");
        } else {
            DB::statement("ALTER TABLE users MODIFY COLUMN alamat TEXT NULL");
        }

        if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'no_telpon')) {
            DB::statement("ALTER TABLE users ADD COLUMN no_telpon VARCHAR(15) NULL");
        } else {
            DB::statement("ALTER TABLE users MODIFY COLUMN no_telpon VARCHAR(15) NULL");
        }

        if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'foto')) {
            DB::statement("ALTER TABLE users ADD COLUMN foto VARCHAR(255) NULL");
        } else {
            DB::statement("ALTER TABLE users MODIFY COLUMN foto VARCHAR(255) NULL");
        }
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','courier','customer','owner') NOT NULL");
        DB::statement("ALTER TABLE users MODIFY COLUMN alamat TEXT NOT NULL");
        DB::statement("ALTER TABLE users MODIFY COLUMN no_telpon VARCHAR(15) NOT NULL");
        DB::statement("ALTER TABLE users MODIFY COLUMN foto VARCHAR(255) NOT NULL");
    }
};
