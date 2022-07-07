<?php

namespace App\Http\Resources;

use App\Models\UrlDownloader;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @codingStandardsIgnoreFile
     */
    public function toArray($request)
    {
        return [
           'id' => $this->id,
           'status' => $this->status,
           'path' => $this->path,
           'url' => $this->url,
           'DownloadLink' => $this->status == UrlDownloader::STATUS_COMPLETE ? url('/download/' . $this->id) : null,
        ];
    }
}
