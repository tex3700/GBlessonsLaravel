<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\News\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class NewsQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = News::query();
    }

    public function getNews(): LengthAwarePaginator
    {
        return $this->model->where('isPrivate', 0)->paginate(config('pagination.news'));
    }

    public function getAllNews(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {

        return $this->model
            ->with('category')
            ->orderBy('id', 'desc')
            ->paginate(config('pagination.admin.news'));
    }

    public function create(array $data): News|bool
    {
        return News::create($data);
    }

    public function update(News $news, array $data): bool
    {
        return $news->fill($data)->save();
    }
}
