<?php

namespace App\Models\News;

class Category
{
    private array $categories = [
        1 => [
            'id' => 1,
            'title' => 'Новости политики',
            'slag' => 'politics-news',
        ],
        2 => [
            'id' => 2,
            'title' => 'Новости спорта',
            'slag' => 'sports-news',
        ],
        3 => [
            'id' => 3,
            'title' => 'Новости технологий',
            'slag' => 'technology-news',
        ],
        4 => [
            'id' => 4,
            'title' => 'Новости исскуства',
            'slag' => 'art-news',
        ],
        5 => [
            'id' => 5,
            'title' => 'Новости погоды',
            'slag' => 'weather-news',
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

    public function getCategoryIdBySlag($slag): ?int
    {
        $id = array_search($slag,
            array_column($this->getNewsCategories(), 'slag', 'id'));

        return !$id ? null : $id;
    }

    public function getCategoryNameBySlag($slag): ?string
    {
        $id = $this->getCategoryIdBySlag($slag);
        $category = $this->getCategoryById($id);

        return is_null($category) ? $category : $category['title'];
    }

}
