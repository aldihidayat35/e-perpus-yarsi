<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Buku Fisik',
                'slug' => 'physical',
                'description' => 'Buku dalam bentuk cetak/fisik yang dapat dipinjam.',
            ],
            [
                'name' => 'E-Book',
                'slug' => 'ebook',
                'description' => 'Buku dalam format digital (PDF) yang dapat dibaca secara online.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
