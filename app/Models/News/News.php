<?php

namespace App\Models\News;

use Illuminate\Support\Str;

class News
{
    private Category $category;

    private array $newsArray = [
        [
            'id' => 1,
            'title' => 'Новость политики 1',
            'text' => 'А у нас новость политики 1 и она очень хорошая!',
            'slug' => 'news_1',
            'isPrivate' => false,
            'category_id' => 1,
        ],
        [
            'id' => 2,
            'title' => 'Новость политики 2',
            'text' => 'А у нас новость политики 2 и она очень хорошая!',
            'slug' => 'news_2',
            'isPrivate' => false,
            'category_id' => 1,
        ],
        [
            'id' => 3,
            'title' => 'Новость политики 3',
            'text' => 'А у нас новость политики 3 и она очень хорошая!',
            'slug' => 'news_3',
            'isPrivate' => false,
            'category_id' => 1,
        ],
        [
            'id' => 4,
            'title' => 'Новость политики 4',
            'text' => 'А у нас новость политики 4 и она очень хорошая!',
            'slug' => 'news_4',
            'isPrivate' => true,
            'category_id' => 1,
        ],
        [
            'id' => 5,
            'title' => 'Новость спорта 1',
            'text' => 'А у нас новость спорта 1 и она очень хорошая!',
            'slug' => 'news_5',
            'isPrivate' => false,
            'category_id' => 2,
        ],
        [
            'id' => 6,
            'title' => 'Новость спорта 2',
            'text' => 'А у нас новость спорта 2 и она очень хорошая!',
            'slug' => 'news_6',
            'isPrivate' => false,
            'category_id' => 2,
        ],
        [
            'id' => 7,
            'title' => 'Новость спорта 3',
            'text' => 'А у нас новость спорта 3 и она очень хорошая!',
            'slug' => 'news_7',
            'isPrivate' => false,
            'category_id' => 2,
        ],
        [
            'id' => 8,
            'title' => 'Новость спорта 4',
            'text' => 'А у нас новость спорта 4 и она очень хорошая!',
            'slug' => 'news_8',
            'isPrivate' => true,
            'category_id' => 2,
        ],
        [
            'id' => 9,
            'title' => 'Новость технологий 1',
            'text' => 'А у нас новость технологий 1 и она очень хорошая!',
            'slug' => 'news_9',
            'isPrivate' => false,
            'category_id' => 3,
        ],
        [
            'id' => 10,
            'title' => 'Новость технологий 2',
            'text' => 'А у нас новость технологий 2 и она очень хорошая!',
            'slug' => 'news_10',
            'isPrivate' => false,
            'category_id' => 3,
        ],
        [
            'id' => 11,
            'title' => 'Новость технологий 3',
            'text' => 'А у нас новость технологий 3 и она очень хорошая!',
            'slug' => 'news_11',
            'isPrivate' => false,
            'category_id' => 3,
        ],
        [
            'id' => 12,
            'title' => 'Новость технологий 4',
            'text' => 'А у нас новость технологий 4 и она очень хорошая!',
            'slug' => 'news_12',
            'isPrivate' => true,
            'category_id' => 3,
        ],
        [
            'id' => 13,
            'title' => 'Новость исскуства 1',
            'text' => 'А у нас новость исскуства 1 и она очень хорошая!',
            'slug' => 'news_13',
            'isPrivate' => false,
            'category_id' => 4,
        ],
        [
            'id' => 14,
            'title' => 'Новость исскуства 2',
            'text' => 'А у нас новость исскуства 2 и она очень хорошая!',
            'slug' => 'news_14',
            'isPrivate' => false,
            'category_id' => 4,
        ],
        [
            'id' => 15,
            'title' => 'Новость исскуства 3',
            'text' => 'А у нас новость исскуства 3 и она очень хорошая!',
            'slug' => 'news_15',
            'isPrivate' => false,
            'category_id' => 4,
        ],
        [
            'id' => 16,
            'title' => 'Новость исскуства 4',
            'text' => 'А у нас новость исскуства 4 и она очень хорошая!',
            'slug' => 'news_16',
            'isPrivate' => true,
            'category_id' => 4,
        ],
        [
            'id' => 17,
            'title' => 'Новость погоды 1',
            'text' => 'А у нас новость погоды 1 и она очень хорошая!',
            'slug' => 'news_17',
            'isPrivate' => false,
            'category_id' => 5,
        ],
        [
            'id' => 18,
            'title' => 'Новость погоды 2',
            'text' => 'А у нас новость погоды 2 и она очень хорошая!',
            'slug' => 'news_18',
            'isPrivate' => false,
            'category_id' => 5,
        ],
        [
            'id' => 19,
            'title' => 'Новость погоды 3',
            'text' => 'А у нас новость погоды 3 и она очень хорошая!',
            'slug' => 'news_19',
            'isPrivate' => false,
            'category_id' => 5,
        ],
        [
            'id' => 20,
            'title' => 'Новость погоды 4',
            'text' => 'А у нас новость погоды 4 и она очень хорошая!',
            'slug' => 'news_20',
            'isPrivate' => false,
            'category_id' => 5,
        ],
    ];

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getNews(): array
    {
        return $this->changeKey($this->newsArray);
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

    public function getNewsByCategorySlag($slag)
    {
        $id = $this->category->getCategoryIdBySlag($slag);
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
