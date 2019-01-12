<?php
require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
	'base_uri' => 'http://localhost:8000',
	'http_errors' => false
]);

$nickname = 'ObjectOrienter'.rand(0,999);
$data = array(
    'nickname' => $nickname,
    'avataNumber' => 5,
    'tagLine' => '<?php'
);
$response = $client->post('/api/programmers', [
    'body' => json_encode($data)
]);

echo $response->getBody();
echo "\n\n";