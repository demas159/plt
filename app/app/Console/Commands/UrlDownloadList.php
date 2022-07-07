<?php

namespace App\Console\Commands;

use App\Models\UrlDownloader;
use Illuminate\Console\Command;

class UrlDownloadList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UrlDownload:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List of url download jobs';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->table(
            ['id', 'url', 'path', 'status'],
            UrlDownloader::all(['id', 'url', 'path', 'status'])->toArray()
        );
    }
}
