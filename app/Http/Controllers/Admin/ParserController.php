<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Parser;
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
     * @param Parser $parser
     * @return Application|RedirectResponse|Redirector
     */
    public function __invoke(Request $request, Parser $parser): Redirector|RedirectResponse|Application
    {
        $load = $parser->setLink("https://www.lenta.ru/rss")
            ->getParseData();
//      dd($load);
        return redirect($parser->updateOrCreateNews($load));
    }
}
