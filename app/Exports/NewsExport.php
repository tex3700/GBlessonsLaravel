<?php

namespace App\Exports;

use App\Models\News\News;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NewsExport implements FromView
{

    public function __construct(
        protected int|string $id,
        protected News $news,
    ) {
    }

    public function view(): View
    {
        return view('exports.news', [
            'news' => $this->news->getNewsByCategoryId($this->id),
        ]);
    }
}
