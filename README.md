## Test task for laravel

Prapared docker for easy start.

###### Short desc:
To set url queue for download you can use:
- 	endpoind: '/',
- 	command: php artisan UrlDownload:download {url}
- 	Rest api endpoind: POST /api/queueUrl with body { url: url}

To see list of all urls wtih statuses:
-  endpoind: /list
-  command php artisan UrlDownload:list
-  Rest api endpoind: Get /api/list with body