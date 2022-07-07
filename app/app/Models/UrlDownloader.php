<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlDownloader extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_DOWNLOADING = 'downloading';
    public const STATUS_COMPLETE = 'complete';
    public const STATUS_ERROR = 'error';

    use HasFactory;
    protected $fillable = [
        'url',
        'path',
        'status',
        'created_at',
        'updated_at',
    ];
    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];
}
