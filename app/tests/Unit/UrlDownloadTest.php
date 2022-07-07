<?php

namespace Tests\Feature;

use App\Models\UrlDownloader;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UrlDownloadTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Test for homePAge.
     *
     * @return void
     */
    public function testCheckHomePageUrl()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('Input url to download');
    }

    /**
     * Test for filling up url in database.
     *
     * @return void
     */
    public function testSetUpDownloadUrl()
    {
        $response = $this->post('/queueUrl', ['url' => 'https://upload.wikimedia.org/wikipedia/en/9/95/Test_image.jpg']);

        $response->assertStatus(302);
    }

    /**
     * Check list.
     *
     * @return void
     */
    public function testChangestatusAndCheckList()
    {
        $response = $this->get('/list');

        $response->assertStatus(200);
    }

    /**
     * Download Test.
     *
     * @return void
     */
    public function testTryToDownload()
    {
        $contents = file_get_contents('https://upload.wikimedia.org/wikipedia/en/9/95/Test_image.jpg');
        $info = pathinfo('https://upload.wikimedia.org/wikipedia/en/9/95/Test_image.jpg');

        if (Storage::disk('local')->put('urlFiles/' . $info['basename'], $contents)) {
            $url = UrlDownloader::where('url', 'https://upload.wikimedia.org/wikipedia/en/9/95/Test_image.jpg')->first();
            $url->update([
                    'status' => UrlDownloader::STATUS_COMPLETE,
                    'path' => 'urlFiles/' . $info['basename'],
                ]);
            $response = $this->call('GET', '/download/' . $url->id);

            $response->assertStatus(200);
            $response->assertDownload();
        }
    }
}
