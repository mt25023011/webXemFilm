<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Phim Lẻ',
            'Phim Bộ',
            'Phim Chiếu Rạp',
            'Phim Hoạt Hình',
            'Phim Tài Liệu',
        ];

        foreach ($categories as $category) {
            Category::create([
                'title' => $category,
                'slug' => Str::slug($category),
                'description' => 'Mô tả cho ' . $category,
                'status' => true,
            ]);
        }
    }
}