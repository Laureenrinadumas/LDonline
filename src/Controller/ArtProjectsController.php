<?php

namespace App\Controller;

use App\Entity\ArtProjects;
use App\Form\ArtProjects1Type;
use App\Repository\ArtProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/art/projects")
 */
class ArtProjectsController extends AbstractController
{
    /**
     * @Route("/", name="art_projects_index", methods={"GET"})
     */
    public function index(ArtProjectsRepository $artProjectsRepository): Response
    {
        return $this->render('art_projects/index.html.twig', [
            'art_projects' => $artProjectsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="art_projects_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artProject = new ArtProjects();
        $form = $this->createForm(ArtProjects1Type::class, $artProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artProject);
            $entityManager->flush();

            return $this->redirectToRoute('art_projects_index');
        }

        return $this->render('art_projects/new.html.twig', [
            'art_project' => $artProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="art_projects_show", methods={"GET"})
     */
    public function show(ArtProjects $artProject): Response
    {
        return $this->render('art_projects/show.html.twig', [
            'art_project' => $artProject,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="art_projects_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ArtProjects $artProject): Response
    {
        $form = $this->createForm(ArtProjects1Type::class, $artProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('art_projects_index');
        }

        return $this->render('art_projects/edit.html.twig', [
            'art_project' => $artProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="art_projects_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ArtProjects $artProject): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artProject->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artProject);
            $entityManager->flush();
        }

        return $this->redirectToRoute('art_projects_index');
    }
}
