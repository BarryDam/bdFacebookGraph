Easy way to exec facebook graph api v2.0 requests in php.

uses the facebook php sdk v4

How to use:

```php
	require getenv('REQUIRES');
	$obj = new bdFacebookGraph(YOUR_APP_ID, YOUR_APP_SECRET);
	$arr = $obj->fetchByRequest('/373569914045?fields=posts');
```