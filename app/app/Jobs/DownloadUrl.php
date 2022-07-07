<?php

namespace App\Jobs;

use App\Models\UrlDownloader;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DownloadUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private UrlDownloader $url;

    /**
     * Create a new job instance.
     *
     * @param UrlDownloader $url
     */
    public function __construct(UrlDownloader $url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->url->status = UrlDownloader::STATUS_DOWNLOADING;
        $this->url->save();

        $this->url->status = UrlDownloader::STATUS_ERROR;

        $filePath = $this->downloadContent($this->url->url);

        if ($filePath != null) {
            $this->url->path = $filePath;
            $this->url->status = UrlDownloader::STATUS_COMPLETE;
        }
        $this->url->save();
    }

    /**
     * Save content in local disk.
     *
     * @param string $url
     *
     * @return string|null
     */
    public function downloadContent(string $url): string|null
    {
        $contents = file_get_contents($url);
        $info = pathinfo($url);
        if (Storage::disk('local')->put('urlFiles/' . $info['basename'], $contents)) {
            return 'urlFiles/' . $info['basename'];
        }

        return null;
    }
}
