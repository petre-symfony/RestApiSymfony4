<?php

namespace App\Tests\Controller\Api;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ProgrammerControllerTest extends TestCase {
	public function testPOST(){
		$client = new Client([
			'base_uri' => 'http://localhost:8000',
			'http_errors' => false
		]);

		$nickname = 'ObjectOrienter'.rand(0,999);
		$data = array(
			'nickname' => $nickname,
			'avatarNumber' => 5,
			'tagLine' => '<?php'
		);

		//1) Post to create the programmer

		$response = $client->post('/api/programmers', [
			'body' => json_encode($data)
		]);

        $this->assertEquals(201,  $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));
        $finishedData = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('nickname', $finishedData);
	}
}
