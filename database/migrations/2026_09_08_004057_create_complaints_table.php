<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('location');
            $table->text('description');
            $table->string('photo')->nullable();
            $table->enum('status', ['Diterima', 'Diproses', 'Selesai', 'Ditolak'])->default('Diterima');
            $table->enum('priority', ['Rendah', 'Sedang', 'Tinggi'])->default('Rendah');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('admin_response')->nullable();
            $table->string('repair_photo')->nullable();
            $table->datetime('processed_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};