<?php

namespace App\Console\Commands;

use App\Traits\UrlValidAndDispatch;
use Illuminate\Console\Command;

class UrlDownloadDownload extends Command
{
    use UrlValidAndDispatch;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UrlDownload:download {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set download queue for url';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $url = $this->argument('url');
        $this->validateAndDispatch($url) ? $this->info('Url set up for download queue') : $this->info('Bad url');
    }
}
