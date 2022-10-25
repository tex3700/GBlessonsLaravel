<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\JobNewsParsing;
use App\Services\Contracts\Parser;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{Request, Response};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;


class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return string
     */
    public function __invoke(Request $request): string
    {
        $start = date('c');
        $urls = DB::select('select url from sources');

        foreach ($urls as $url) {

            \dispatch(new JobNewsParsing($url->url));
        }

        return "Parsing completed ". $start . ' ' . date('c');
    }
}
