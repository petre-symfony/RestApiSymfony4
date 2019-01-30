<?php

namespace App\Tests\Controller\Api;

use App\Tests\ApiTestCase;

class ProgrammerControllerTest extends ApiTestCase {
	
	protected function setUp(){
		parent::setUp();
		$this->createUser('weaverryan');
	}
	
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
	
	public function testGetProgrammer(){
		$this->createProgrammer([
				'nickname' => 'UnitTester',
				'avatarNumber' => '3'
		]);
		$response = $this->client->get('/api/programmers/UnitTester');
		$this->assertEquals(200, $response->getStatusCode());
		$data = json_decode($response->getBody(), true);
		$this->assertEquals(
				[
						'nickname',
						'avatarNumber',
						'powerLevel',
						'tagLine'
				],
				array_keys($data)
		);
	}
}
