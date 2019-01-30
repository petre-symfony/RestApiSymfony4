<?php

namespace App\Tests\Controller\Api;

use App\Tests\ApiTestCase;

class ProgrammerControllerTest extends ApiTestCase {
	public function testPOST(){
		
		$data = array(
			'nickname' => 'ObjectOrienter',
			'avatarNumber' => 5,
			'tagLine' => '<?php'
		);

		//1) Post to create the programmer

		$response = $this->client->post('/api/programmers', [
			'body' => json_encode($data)
		]);

        $this->assertEquals(201,  $response->getStatusCode());
        $this->assertEquals('/api/programmers/ObjectOrienter', $response->getHeader('Location')[0]);
        $finishedData = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('nickname', $finishedData);
	}
}
