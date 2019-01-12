<?php

namespace App\Tests\Controller\Api;

use App\Tests\ApiTestCase;
use GuzzleHttp\Client;

class ProgrammerControllerTest extends ApiTestCase {
	public function testPOST(){
		$client = new Client([
			'base_uri' => 'http://localhost:8000',
			'http_errors' => false
		]);

		$data = array(
			'nickname' => 'ObjectOrienter',
			'avatarNumber' => 5,
			'tagLine' => '<?php'
		);

		//1) Post to create the programmer

		$response = $client->post('/api/programmers', [
			'body' => json_encode($data)
		]);

        $this->assertEquals(201,  $response->getStatusCode());
        $this->assertEquals('/api/programmers/ObjectOrienter',$response->getHeader('Location')[0]);
        $finishedData = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('nickname', $finishedData);
	}
}
