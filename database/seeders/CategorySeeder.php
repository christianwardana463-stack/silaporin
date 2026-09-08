<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Kelas', 'description' => 'Ruang kelas belajar siswa'],
            ['name' => 'Laboratorium', 'description' => 'Lab IPA, Fisika, Kimia, Komputer'],
            ['name' => 'Kamar Mandi', 'description' => 'Toilet dan fasilitas kebersihan'],
            ['name' => 'Lapangan', 'description' => 'Lapangan olahraga dan upacara'],
            ['name' => 'Perpustakaan', 'description' => 'Ruang baca dan buku'],
            ['name' => 'Aula', 'description' => 'Ruang pertemuan dan kegiatan'],
            ['name' => 'Mushola', 'description' => 'Tempat ibadah'],
            ['name' => 'Fasilitas Lainnya', 'description' => 'Sarana lainnya'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}