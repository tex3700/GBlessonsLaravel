<?php

namespace App\Models\News;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class News
{

    public function __construct(
        private Category $category
    ) {
    }

    public function getNews(): Collection
    {
        return DB::table('news')->get();
    }

    public function saveNews($news): int
    {
        $news['isPrivate'] = array_key_exists('isPrivate', $news) ? '1' : '0';

        return DB::table('news')->insertGetId($news);
    }

    public function getNewsById($id)
    {
        return DB::table('news')->find($id);
    }

    public function getNewsByCategoryId($category_id): Collection
    {
        return DB::table('news')->where('category_id', $category_id)->get();
    }

    public function getNewsByCategorySlug($slug): Collection
    {
        $id = $this->category->getCategoryIdBySlug($slug);

        return DB::table('news')->where('category_id', $id)->get();
    }

}
