<?php
/**
 * Created by PhpStorm.
 * User: petrero
 * Date: 27.09.2018
 * Time: 07:44
 */

namespace App\Controller\Api;


use App\Entity\Programmer;
use App\Form\ProgrammerType;
use App\Repository\ProgrammerRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammerController extends AbstractController{
	/**
	 * @Route("/api/programmers", methods="POST")
	 */
    public function newAction(Request $request,
        UserRepository $userRepository)
    {

        $body = $request->getContent();
        $data = json_decode($body, true);

        $programmer = new Programmer();
        $form = $this->createForm(ProgrammerType::class, $programmer);
        $form->submit($data);

        $programmer->setUser($userRepository->findOneBy(['username' => 'weaverryan']));
        $em = $this->getDoctrine()->getManager();
        $em->persist($programmer);
        $em->flush();

        $data = $this->serializeProgrammer($programmer);
        $response =  new Response(json_encode($data), 201);
        return new JsonResponse($data, 201, [
            'Location' => $this->generateUrl("api_programmers_show", [
                'nickname' => $programmer->getNickname()
            ])
        ]);
    }

    /**
     * @Route("/api/programmers/{nickname}", name="api_programmers_show", methods="GET")
     */
    public function showAction(Programmer $programmer){
        if(!$programmer){
            throw $this->createNotFoundException('No programmer found for username ' . $nickname);
        }

        $data = $this->serializeProgrammer($programmer);

        $response =  new Response(json_encode($data));
        return new JsonResponse($data);
    }

    /**
     * @Route("/api/programmers", name="api_programmers_list", methods="GET")
     */
    public function listAction(ProgrammerRepository $programmerRepository){
        $programmers  = $programmerRepository->findAll();

        $data = ['programmers' => []];

        foreach ($programmers as $programmer){
            $data['programmers'][] = $this->serializeProgrammer($programmer);
        }
        return new JsonResponse($data);
    }

    private function serializeProgrammer(Programmer $programmer){
        return [
            'nickname' => $programmer->getNickname(),
            'avatarNumber' => $programmer->getAvatarNumber(),
            'powerLevel' => $programmer->getPowerLevel(),
            'tagLine' => $programmer->getTagLine()
        ];
    }
	
	/**
	 * @Route("/api/programmers/{nickname}", name="api_programmers_update", methods="PUT")
	 */
	public function putAction($nickname, Request $request,
    ProgrammerRepository $programmerRepository
	){
		$programmer = $programmerRepository->findOneBy(['nickname' => $nickname]);
		if(!$programmer){
			throw $this->createNotFoundException('No programmer found for username ' . $nickname);
		}
		$body = $request->getContent();
		$data = json_decode($body, true);
		$form = $this->createForm(ProgrammerType::class, $programmer);
		$form->submit($data);
		$em = $this->getDoctrine()->getManager();
		$em->persist($programmer);
		$em->flush();
		$data = $this->serializeProgrammer($programmer);
		$response =  new Response(json_encode($data), 201);
		return new JsonResponse($data, 200);
	}
}