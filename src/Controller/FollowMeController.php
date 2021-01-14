<?php

namespace App\Controller;

use App\Entity\FollowMe;
use App\Form\FollowMe1Type;
use App\Repository\FollowMeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/follow/me")
 */
class FollowMeController extends AbstractController
{
    /**
     * @Route("/", name="follow_me_index", methods={"GET"})
     */
    public function index(FollowMeRepository $followMeRepository): Response
    {
        return $this->render('follow_me/index.html.twig', [
            'follow_mes' => $followMeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="follow_me_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $followMe = new FollowMe();
        $form = $this->createForm(FollowMe1Type::class, $followMe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($followMe);
            $entityManager->flush();

            return $this->redirectToRoute('follow_me_index');
        }

        return $this->render('follow_me/new.html.twig', [
            'follow_me' => $followMe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="follow_me_show", methods={"GET"})
     */
    public function show(FollowMe $followMe): Response
    {
        return $this->render('follow_me/show.html.twig', [
            'follow_me' => $followMe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="follow_me_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FollowMe $followMe): Response
    {
        $form = $this->createForm(FollowMe1Type::class, $followMe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('follow_me_index');
        }

        return $this->render('follow_me/edit.html.twig', [
            'follow_me' => $followMe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="follow_me_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FollowMe $followMe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$followMe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($followMe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('follow_me_index');
    }
}
