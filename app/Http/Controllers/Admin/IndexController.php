<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\StreamedResponse;

class IndexController extends Controller
{

    public function index(): Factory|View|Application
    {
        return view('admin.index');
    }


    public function downloadImg(): StreamedResponse
    {
        return Storage::download('/public/1.jpg');
    }
}
