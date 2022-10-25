<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\Contracts\Parser;
use Illuminate\Routing\Redirector;

class JobNewsParsing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $link
    ) {
    }

    /**
     * Execute the job.
     *
     * @param Parser $parser
     * @return void
     */
    public function handle(Parser $parser): void
    {
        $load = $parser->setLink($this->link)->getParseData();

        $parser->updateOrCreateNews($load);
    }
}
