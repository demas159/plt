<?php

namespace App\Http\Controllers;

use App\Http\Resources\UrlResource;
use App\Models\UrlDownloader;
use App\Traits\UrlValidAndDispatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UrlDownloaderController extends Controller
{
    use UrlValidAndDispatch;

    /**
     * Index view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('form', ['error' => '']);
    }

    /**
     * Queue url for download job.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function queueUrl(Request $request)
    {
        return $this->validateAndDispatch($request->url) ? redirect('/list') : view('form', ['error' => 'Bad url']);
    }

    /**
     * APi method.
     *
     * @param Request $request
     *
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function queueUrlApi(Request $request)
    {
        return $this->validateAndDispatch($request->url) ? response()->json([]) : response()->json(['error' => 'Bad url']);
    }

    /**
     * List of all urls.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listAllUrls()
    {
        return view('list', ['urls' => UrlDownloader::all()]);
    }

    /**
     * List of all urls Api method.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listAllUrlsApi()
    {
        return UrlResource::collection(UrlDownloader::all());
    }

    /**
     * Download file from storage.
     *
     * @param UrlDownloader $url
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(UrlDownloader $url)
    {
        return Storage::download($url->path);
    }
}
