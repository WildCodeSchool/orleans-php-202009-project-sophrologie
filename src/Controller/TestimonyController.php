<?php

namespace App\Controller;

use App\Entity\Testimony;
use App\Form\TestimonyType;
use App\Repository\TestimonyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/temoignage")
 */
class TestimonyController extends AbstractController
{
    /**
     * @Route("/", name="testimony_index", methods={"GET"})
     * @param TestimonyRepository $testimonyRepository
     * @return Response
     */
    public function index(TestimonyRepository $testimonyRepository): Response
    {
        return $this->render('testimony/index.html.twig', [
            'testimonies' => $testimonyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="testimony_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $testimony = new Testimony();
        $form = $this->createForm(TestimonyType::class, $testimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($testimony);
            $entityManager->flush();

            return $this->redirectToRoute('testimony_index');
        }

        return $this->render('testimony/new.html.twig', [
            'testimony' => $testimony,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="testimony_show", methods={"GET"})
     * @param Testimony $testimony
     * @return Response
     */
    public function show(Testimony $testimony): Response
    {
        return $this->render('testimony/show.html.twig', [
            'testimony' => $testimony,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="testimony_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Testimony $testimony
     * @return Response
     */
    public function edit(Request $request, Testimony $testimony): Response
    {
        $form = $this->createForm(TestimonyType::class, $testimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('testimony_index');
        }

        return $this->render('testimony/edit.html.twig', [
            'testimony' => $testimony,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="testimony_delete", methods={"DELETE"})
     * @param Request $request
     * @param Testimony $testimony
     * @return Response
     */
    public function delete(Request $request, Testimony $testimony): Response
    {
        if ($this->isCsrfTokenValid('delete' . $testimony->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($testimony);
            $entityManager->flush();
        }

        return $this->redirectToRoute('testimony_index');
    }
}
