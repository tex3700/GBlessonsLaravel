<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{

    private array $categories = [
        1 => [
            'id' => 1,
            'title' => 'Новости политики',
            'slug' => 'politics-news',
        ],
        2 => [
            'id' => 2,
            'title' => 'Новости спорта',
            'slug' => 'sports-news',
        ],
        3 => [
            'id' => 3,
            'title' => 'Новости технологий',
            'slug' => 'technology-news',
        ],
        4 => [
            'id' => 4,
            'title' => 'Новости исскуства',
            'slug' => 'art-news',
        ],
        5 => [
            'id' => 5,
            'title' => 'Новости погоды',
            'slug' => 'weather-news',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('newsCategory')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
       foreach ($this->categories as $category) {
           $data[] = [
               'id' => $category['id'],
               'title' => $category['title'],
               'slug' => Str::slug($category['title'], '-'),
               ];
       }
       return $data;
    }
}
