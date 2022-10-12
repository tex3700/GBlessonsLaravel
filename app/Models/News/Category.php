<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'news_categories';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category_id', 'id');
    }

   /* public function getNewsCategories(): Collection
    {
        return DB::table('news_categories')->get();
    }

    public function getCategoryById($id)
    {
        return DB::table('news_categories')->find($id);
    }

    public function getCategoryIdBySlug($slug): ?int
    {
        return DB::table('news_categories')
            ->where('slug', $slug)
            ->value('id');
    }

    public function getCategoryNameBySlug($slug): ?string
    {
        return DB::table('news_categories')
            ->where('slug', $slug)
            ->value('title');
    }*/

}
