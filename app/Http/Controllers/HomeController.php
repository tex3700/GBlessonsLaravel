<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\{View, Factory};
use Illuminate\Contracts\Foundation\Application;

class HomeController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('index');
    }
}
