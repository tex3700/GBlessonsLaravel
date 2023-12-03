<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class News
 * @package App\Models\News
 *
 * @property string title
 * @property string text
 * @property boolean isPrivate
 */
class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'text',
        'isPrivate',
        'image',
        'pubDate',
        'link',
        'created_at',
    ];

    protected $casts = [
        'isPrivate' => 'bool',
    ];

    public function category(): Model|BelongsTo|null
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /*public function __construct(
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
    }*/

}
