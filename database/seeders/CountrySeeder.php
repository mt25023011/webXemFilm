<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            'Việt Nam',
            'Mỹ',
            'Hàn Quốc',
            'Nhật Bản',
            'Trung Quốc',
            'Anh',
            'Pháp',
            'Ấn Độ',
            'Thái Lan',
            'Nga',
        ];

        foreach ($countries as $country) {
            Country::create([
                'title' => $country,
                'slug' => Str::slug($country),
                'description' => 'Mô tả cho quốc gia ' . $country,
                'status' => true,
            ]);
        }
    }
}
