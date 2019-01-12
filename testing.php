<?php
require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
	'base_uri' => 'http://localhost:8000',
	'http_errors' => false
]);

$response = $client->post('/api/programmers');
echo $response->getBody();
echo "\n\n";