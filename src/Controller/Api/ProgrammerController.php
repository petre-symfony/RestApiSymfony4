<?php
/**
 * Created by PhpStorm.
 * User: petrero
 * Date: 27.09.2018
 * Time: 07:44
 */

namespace App\Controller\Api;


use App\Entity\Programmer;
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

        $programmer = new Programmer($data['nickname'], $data['avatarNumber']);
        $programmer->setTagLine($data['tagLine']);
        $programmer->setUser($userRepository->findOneBy(['username' => 'weaverryan']));
        $em = $this->getDoctrine()->getManager();
        $em->persist($programmer);
        $em->flush();
        return new Response('It worked. Believe me - I\'m an API');
    }
}