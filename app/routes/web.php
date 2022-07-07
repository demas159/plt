<?php

use App\Http\Controllers\UrlDownloaderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UrlDownloaderController::class, 'index']);
Route::post('/queueUrl', [UrlDownloaderController::class, 'queueUrl']);
Route::get('/list', [UrlDownloaderController::class, 'listAllUrls']);
Route::get('/download/{url}', [UrlDownloaderController::class, 'download']);
