<?php

namespace App\Controller;

use App\Entity\Speciality;
use App\Form\SpecialityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminHomeController
 * @package App\Controller
 * @Route("/admin/speciality", name="admin_")
 */
class AdminSpecialityController extends AbstractController
{
    /**
     * @Route("/index", name="index_speciality")
     * @return Response
     */
    public function index(): Response
    {
        $specialities = $this->getDoctrine()
            ->getRepository(Speciality::class)
            ->findAll();

        return $this->render(
            'speciality/indexAdmin.html.twig',
            [
                'specialities' => $specialities]
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/new",  name="new_speciality")
     */
    public function new(Request $request): Response
    {
        $speciality = new Speciality();
        $form = $this->createForm(SpecialityType::class, $speciality);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($speciality);
            $entityManager->flush();
            return $this->redirectToRoute('admin_index_speciality');
        }
        return $this->render('speciality/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit_speciality", methods={"GET","POST"})
     * @param Request $request
     * @param Speciality $speciality
     * @return Response
     */
    public function edit(Request $request, Speciality $speciality): Response
    {
        $form = $this->createForm(SpecialityType::class, $speciality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_index_speciality');
        }

        return $this->render('speciality/edit.html.twig', [
            'speciality' => $speciality,
            'form' => $form->createView(),
        ]);
    }
}
