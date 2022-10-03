<?php

namespace App\Models\News;

class Category
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

    public function getNewsCategories(): array
    {
        return $this->categories;
    }

    public function getCategoryById($id): ?array
    {
        $category = $this->getNewsCategories();
        return array_key_exists($id, $category) ? $category[$id] : null;
    }

    public function getCategoryIdBySlug($slug): ?int
    {
        $id = array_search($slug,
            array_column($this->getNewsCategories(), 'slug', 'id'));

        return !$id ? null : $id;
    }

    public function getCategoryNameBySlug($slug): ?string
    {
        $id = $this->getCategoryIdBySlug($slug);
        $category = $this->getCategoryById($id);

        return is_null($category) ? $category : $category['title'];
    }

}
