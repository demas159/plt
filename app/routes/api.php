<?php

use App\Http\Controllers\UrlDownloaderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/queueUrl', [UrlDownloaderController::class, 'queueUrlApi']);
Route::get('/list', [UrlDownloaderController::class, 'listAllUrlsApi']);
Route::get('/download/{url}', [UrlDownloaderController::class, 'download']);
