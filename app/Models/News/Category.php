<?php

namespace App\Models\News;

class Category
{
    private array $categories = [
        [
            'id' => 1,
            'title' => 'Новости политики',
            'slag' => 'politics-news',
        ],
        [
            'id' => 2,
            'title' => 'Новости спорта',
            'slag' => 'sports-news',
        ],
        [
            'id' => 3,
            'title' => 'Новости технологий',
            'slag' => 'technology-news',
        ],
        [
            'id' => 4,
            'title' => 'Новости исскуства',
            'slag' => 'art-news',
        ],
        [
            'id' => 5,
            'title' => 'Новости погоды',
            'slag' => 'weather-news',
        ],
    ];

    public function getNewsCategories(): array
    {
        return $this->categories;
    }

}
