<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Hành Động',
            'Phiêu Lưu',
            'Hài Hước',
            'Tình Cảm',
            'Kinh Dị',
            'Khoa Học Viễn Tưởng',
            'Thể Thao',
            'Tội Phạm',
            'Chiến Tranh',
            'Gia Đình',
        ];

        foreach ($genres as $genre) {
            Genre::create([
                'title' => $genre,
                'slug' => Str::slug($genre),
                'description' => 'Mô tả cho thể loại ' . $genre,
                'status' => true,
            ]);
        }
    }
}
