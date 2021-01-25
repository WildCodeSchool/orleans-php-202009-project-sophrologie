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
 * @Route("/admin/specialite", name="admin_")
 */
class AdminSpecialityController extends AbstractController
{
    /**
     * @Route("/", name="index_speciality")
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
     * @Route("/nouveau",  name="new_speciality")
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
            $this->addFlash('success', 'La spécialité a bien été ajoutée');
            return $this->redirectToRoute('admin_index_speciality');
        }
        return $this->render('speciality/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="edit_speciality", methods={"GET","POST"})
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
            $this->addFlash('success', 'La spécialité a bien été modifiée');

            return $this->redirectToRoute('admin_index_speciality');
        }

        return $this->render('speciality/edit.html.twig', [
            'speciality' => $speciality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/supprimer", name="delete_speciality", methods={"DELETE"})
     * @param Request $request
     * @param Speciality $speciality
     * @return Response
     */
    public function delete(Request $request, Speciality $speciality): Response
    {
        if ($this->isCsrfTokenValid('delete' . $speciality->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($speciality);
            $entityManager->flush();
            $this->addFlash('danger', 'La spécialité a bien été supprimée');
        }

        return $this->redirectToRoute('admin_index_speciality');
    }
}
