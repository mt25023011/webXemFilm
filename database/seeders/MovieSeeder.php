<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use Illuminate\Support\Str;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movies = [
            [
                'title' => 'Avengers: Endgame',
                'description' => 'Sau sự kiện Thanos xóa sổ một nửa vũ trụ, các Avengers còn lại phải tập hợp lại một lần nữa để đảo ngược tình thế.',
                'type' => 'single',
                'release_date' => '2019-04-26',
                'duration' => 181,
                'resolution' => 1080,
                'language' => 'Tiếng Anh',
                'quality' => 'HD',
                'rating' => 8.5,
                'imdb_rating' => 8.4,
                'views' => 1000000,
                'category_id' => 1, // Phim Lẻ
                'genre_id' => 1, // Hành Động
                'country_id' => 2, // Mỹ
            ],
            [
                'title' => 'Stranger Things',
                'description' => 'Khi một cậu bé biến mất, một thị trấn nhỏ phát hiện ra một loạt các sự kiện bí ẩn, các thí nghiệm bí mật, và một cô gái siêu nhiên đáng sợ.',
                'type' => 'series',
                'release_date' => '2016-07-15',
                'duration' => 50,
                'resolution' => 1080,
                'language' => 'Tiếng Anh',
                'quality' => 'HD',
                'rating' => 8.7,
                'imdb_rating' => 8.7,
                'views' => 2000000,
                'category_id' => 2, // Phim Bộ
                'genre_id' => 6, // Khoa Học Viễn Tưởng
                'country_id' => 2, // Mỹ
            ],
            [
                'title' => 'Parasite',
                'description' => 'Gia đình Kim sống trong một căn hộ tồi tàn và tìm cách kiếm sống bằng cách làm việc cho gia đình Park giàu có.',
                'type' => 'single',
                'release_date' => '2019-05-30',
                'duration' => 132,
                'resolution' => 1080,
                'language' => 'Tiếng Hàn',
                'quality' => 'HD',
                'rating' => 8.6,
                'imdb_rating' => 8.5,
                'views' => 500000,
                'category_id' => 1, // Phim Lẻ
                'genre_id' => 8, // Tội Phạm
                'country_id' => 3, // Hàn Quốc
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create([
                'title' => $movie['title'],
                'slug' => Str::slug($movie['title']),
                'description' => $movie['description'],
                'image' => 'movies/' . Str::slug($movie['title']) . '.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => $movie['type'],
                'release_date' => $movie['release_date'],
                'duration' => $movie['duration'],
                'resolution' => $movie['resolution'],
                'language' => $movie['language'],
                'quality' => $movie['quality'],
                'rating' => $movie['rating'],
                'imdb_rating' => $movie['imdb_rating'],
                'views' => $movie['views'],
                'category_id' => $movie['category_id'],
                'genre_id' => $movie['genre_id'],
                'country_id' => $movie['country_id'],
                'status' => true,
            ]);
        }
    }
}
