<?php
namespace App\Tests;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApiTestCase extends KernelTestCase {
	private static $staticClient;

	/** @var  Client*/
	protected $client;

	public static function setUpBeforeClass(){
		self::$staticClient = new Client([
			'base_uri' => 'http://localhost',
			'http_errors' => false
		]);

        self::bootKernel();
	}

	public function setUp(){
		$this->client = self::$staticClient;

		$this->purgeDatabase();
	}

    public function tearDown(){
        //purposefully overriding so Symfony's kernel isn't shut down
    }
    protected function getService($id){
        return self::$kernel->getContainer()->get($id);
    }
    private function purgeDatabase(){
        $purger = new ORMPurger($this->getService('doctrine')->getManager());
        $purger->purge();
    }
}