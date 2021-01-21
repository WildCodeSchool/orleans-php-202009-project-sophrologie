<?php

namespace App\Controller;

use App\Entity\Logo;
use App\Form\LogoType;
use App\Repository\LogoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/logo", name="admin_logo_")
 */
class AdminLogoController extends AbstractController
{
    /**
     * @Route("/", name="logo_index", methods={"GET"})
     */
    public function index(LogoRepository $logoRepository): Response
    {
        return $this->render('logo/index.html.twig', [
            'logos' => $logoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $logo = new Logo();
        $form = $this->createForm(LogoType::class, $logo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($logo);
            $entityManager->flush();
            $this->addFlash('success', 'L\'entreprise a bien été ajoutée');

            return $this->redirectToRoute('admin_logo_index');
        }

        return $this->render('admin_logo/new.html.twig', [
            'logo' => $logo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="logo_show", methods={"GET"})
     */
    public function show(Logo $logo): Response
    {
        return $this->render('logo/show.html.twig', [
            'logo' => $logo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="logo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Logo $logo): Response
    {
        $form = $this->createForm(LogoType::class, $logo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('logo_index');
        }

        return $this->render('logo/edit.html.twig', [
            'logo' => $logo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="logo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Logo $logo): Response
    {
        if ($this->isCsrfTokenValid('delete' . $logo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($logo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('logo_index');
    }
}
