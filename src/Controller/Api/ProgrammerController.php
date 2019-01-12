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
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        $response =  new Response('It worked. Believe me - I\'m an API', 201);
        $response->headers->set('Location', $this->generateUrl("api_programmers_show", [
            'nickname' => $programmer->getNickname()
        ]));

        return $response;;
    }

    /**
     * @Route("/api/programmers/{nickname}", name="api_programmers_show", methods="GET")
     */
    public function showAction(Programmer $programmer){
        $data = [
            'nickname' => $programmer->getNickname(),
            'avatarNumber' => $programmer->getAvatarNumber(),
            'powerLevel' => $programmer->getPowerLevel(),
            'tagLine' => $programmer->getTagLine()
        ];

        return new Response(json_encode($data));
    }
}