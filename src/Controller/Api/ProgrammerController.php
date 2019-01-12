<?php
/**
 * Created by PhpStorm.
 * User: petrero
 * Date: 27.09.2018
 * Time: 07:44
 */

namespace App\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammerController extends AbstractController{
	/**
	 * @Route("/api/programmers", methods="POST")
	 */
    public function newAction(Request $request){

        $body = $request->getContent();

        return new Response($body);
    }
}