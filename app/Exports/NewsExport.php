<?php

namespace App\Exports;

use App\Models\News\News;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NewsExport implements FromView
{

    public function __construct(
        private int|string $id,
    ) {
    }

    public function view(): View
    {
        return view('exports.news')->with(
            'news',
            News::where('category_id', $this->id)->get()
        );
    }
}
