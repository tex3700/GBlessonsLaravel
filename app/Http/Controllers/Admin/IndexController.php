<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;

class IndexController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('admin.index');
    }
}
