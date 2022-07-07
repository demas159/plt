<?php

namespace App\Traits;

use App\Jobs\DownloadUrl;
use App\Models\UrlDownloader;

trait UrlValidAndDispatch
{
    /**
     * Url validation and job dispatch.
     *
     * @param string $url
     *
     * @return bool
     */
    private function validateAndDispatch(string $url): bool
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        $oUrl = UrlDownloader::firstOrCreate([
            'url' => $url,
        ]);

        if ($oUrl->status === UrlDownloader::STATUS_PENDING) {
            DownloadUrl::dispatch($oUrl);
        }

        return true;
    }
}
