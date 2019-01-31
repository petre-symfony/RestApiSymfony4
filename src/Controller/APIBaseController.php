<?php
namespace App\Controller;


use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class APIBaseController extends AbstractController {
	private $serializer;

	public function __construct(SerializerInterface $serializer){
		$this->serializer = $serializer;
	}

	protected function serialize($data){
		return $this->serializer->serialize($data, 'json');
	}

	protected function createAPIResponse($data, $statusCode = 200){
		$json = $this->serialize($data);

		return new Response($json, $statusCode, [
			'Content-Type' => 'application/json'
		]);
	}
}