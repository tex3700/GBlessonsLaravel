<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsExport;
use App\Http\Controllers\Controller;
use App\Models\News\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return View|Factory|BinaryFileResponse|Application
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke(Request $request): View|Factory|BinaryFileResponse|Application
    {
        if ($request->isMethod('post')) {
            $id = $request->except('token');

            return Excel::download(new NewsExport($id['category']), 'news.xlsx');
        }

        return view('admin.news.export', [
            'categories' => Category::all(),
        ]);
    }
}
