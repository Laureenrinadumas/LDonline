<?php

namespace App\Controller;

use App\Entity\DigitalProjects;
use App\Form\DigitalProjects1Type;
use App\Repository\DigitalProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/digital/projects")
 */
class DigitalProjectsController extends AbstractController
{
    /**
     * @Route("/", name="digital_projects_index", methods={"GET"})
     */
    public function index(DigitalProjectsRepository $digitalProjectsRepository): Response
    {
        return $this->render('digital_projects/index.html.twig', [
            'digital_projects' => $digitalProjectsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="digital_projects_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $digitalProject = new DigitalProjects();
        $form = $this->createForm(DigitalProjects1Type::class, $digitalProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($digitalProject);
            $entityManager->flush();

            return $this->redirectToRoute('digital_projects_index');
        }

        return $this->render('digital_projects/new.html.twig', [
            'digital_project' => $digitalProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="digital_projects_show", methods={"GET"})
     */
    public function show(DigitalProjects $digitalProject): Response
    {
        return $this->render('digital_projects/show.html.twig', [
            'digital_project' => $digitalProject,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="digital_projects_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DigitalProjects $digitalProject): Response
    {
        $form = $this->createForm(DigitalProjects1Type::class, $digitalProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('digital_projects_index');
        }

        return $this->render('digital_projects/edit.html.twig', [
            'digital_project' => $digitalProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="digital_projects_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DigitalProjects $digitalProject): Response
    {
        if ($this->isCsrfTokenValid('delete'.$digitalProject->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($digitalProject);
            $entityManager->flush();
        }

        return $this->redirectToRoute('digital_projects_index');
    }
}
