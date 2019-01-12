<?php
namespace App\Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ApiTestCase extends TestCase {
	private static $staticClient;

	/** @var  Client*/
	protected $client;

	public static function setUpBeforeClass(){
		self::$staticClient = new Client([
			'base_uri' => 'http://localhost',
			'http_errors' => false
		]);
	}

	public function setUp(){
		$this->client = self::$staticClient;
	}
}