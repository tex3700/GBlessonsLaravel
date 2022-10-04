<?php

namespace App\Models\News;

use Illuminate\Support\Facades\Storage;

class News
{
    private Category $category;

    private array $newsArray = [];

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getNews(): array
    {
        return json_decode(Storage::disk('local')->get('news.json'), true);
    }

    public function saveNews($news): int
    {
        $newsArray = $this->getNews();
        $id = (array_key_last($newsArray)) + 1;

        $news += array(
            'id'=> $id,
            'isPrivate' => array_key_exists('isPrivate', $news) ? '1' : '0');
        $newsArray[] = $news;

        Storage::disk('local')->put('news.json',
            json_encode($newsArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        return $id;
    }

    public function getNewsById($id): ?array
    {
            $news = $this->getNews();
            return array_key_exists($id, $news) ? $news[$id] : null;
    }

    public function getNewsByCategoryId($category_id): ?array
    {
        foreach ($this->getNews() as $news) {
            if ($news['category_id'] == $category_id) {
                $arrayNews[] = $news;
            }
        }
        if (empty($arrayNews)) {
            return null;
        }

        return $arrayNews;
    }

    public function getNewsByCategorySlug($slug): ?array
    {
        $id = $this->category->getCategoryIdBySlug($slug);
        foreach ($this->getNews() as $news) {
            if ($news['category_id'] == $id) {
                $arrayNews[] = $news;
            }
        }

        return empty($arrayNews) ? null : $arrayNews;
    }

    function changeKey($array): array
    {
        $newKeys=[];
        foreach ($array as $value){
            $key = $value['id'];
            $newKeys[$key] = $value;
        }
        return $newKeys;
    }

}
