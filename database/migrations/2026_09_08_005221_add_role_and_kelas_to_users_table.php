<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['Admin', 'Siswa'])->default('Siswa')->after('password');
            $table->string('kelas')->nullable()->after('role');
            $table->string('no_hp')->nullable()->after('kelas');
            $table->string('foto_profil')->nullable()->after('no_hp');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'kelas', 'no_hp', 'foto_profil']);
        });
    }
};