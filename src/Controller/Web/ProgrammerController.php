<?php
namespace App\Controller\Web;

use App\Entity\Programmer;
use App\Form\ProgrammerType;
use App\Repository\ProgrammerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/programmer")
 */
class ProgrammerController extends AbstractController {
    /**
     * @Route("/new", name="programmer_new", methods="GET|POST")
     */
    public function new(Request $request): Response {
        $programmer = new Programmer();
        $form = $this->createForm(ProgrammerType::class, $programmer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $programmer->setUser($this->getUser());
            $em->persist($programmer);
            $em->flush();
            return $this->redirectToRoute('programmer_show', [
                'nickname' => $programmer->getNickname()
            ]);
        }
        return $this->render('programmer/new.html.twig', [
            'programmer' => $programmer,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{nickname}", name="programmer_show", methods="GET")
     */
    public function show(Programmer $programmer): Response {
        return $this->render('programmer/show.html.twig', ['programmer' => $programmer]);
    }
}