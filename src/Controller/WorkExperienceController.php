<?php

namespace App\Controller;

use App\Entity\WorkExperience;
use App\Form\WorkExperienceType;
use App\Repository\WorkExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/work/experience")
 */
class WorkExperienceController extends AbstractController
{
    /**
     * @Route("/", name="work_experience_index", methods={"GET"})
     */
    public function index(WorkExperienceRepository $workExperienceRepository): Response
    {
        return $this->render('work_experience/header.html.twig', [
            'work_experiences' => $workExperienceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="work_experience_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $workExperience = new WorkExperience();
        $form = $this->createForm(WorkExperienceType::class, $workExperience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workExperience);
            $entityManager->flush();

            return $this->redirectToRoute('work_experience_index');
        }

        return $this->render('work_experience/new.html.twig', [
            'work_experience' => $workExperience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="work_experience_show", methods={"GET"})
     */
    public function show(WorkExperience $workExperience): Response
    {
        return $this->render('work_experience/show.html.twig', [
            'work_experience' => $workExperience,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="work_experience_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WorkExperience $workExperience): Response
    {
        $form = $this->createForm(WorkExperienceType::class, $workExperience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('work_experience_index');
        }

        return $this->render('work_experience/edit.html.twig', [
            'work_experience' => $workExperience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="work_experience_delete", methods={"DELETE"})
     */
    public function delete(Request $request, WorkExperience $workExperience): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workExperience->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workExperience);
            $entityManager->flush();
        }

        return $this->redirectToRoute('work_experience_index');
    }
}
