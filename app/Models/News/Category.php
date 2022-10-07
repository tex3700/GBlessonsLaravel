<?php

namespace App\Models\News;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Category
{

    public function getNewsCategories(): Collection
    {
        return DB::table('newsCategory')->get();
    }

    public function getCategoryById($id)
    {
        return DB::table('newsCategory')->find($id);
    }

    public function getCategoryIdBySlug($slug): ?int
    {
        return DB::table('newsCategory')
            ->where('slug', $slug)
            ->value('id');
    }

    public function getCategoryNameBySlug($slug): ?string
    {
        return DB::table('newsCategory')
            ->where('slug', $slug)
            ->value('title');
    }

}
