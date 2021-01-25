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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/admin/logo", name="admin_logo_")
 */
class AdminLogoController extends AbstractController
{
    /**
     *     * @Route("/index", name="index")
     */

    public function index(LogoRepository $logoRepository): Response
    {
        return $this->render('admin_logo/index.html.twig', [
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
     * @Route("/edit/{id}", name="edit")
     * @ParamConverter("logo", class="App\Entity\Logo", options={"mapping": {"id": "id"}})
     */
    public function edit(Request $request, Logo $logo): Response
    {
        $form = $this->createForm(LogoType::class, $logo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\'entreprise a bien été modifiée');
            return $this->redirectToRoute('admin_logo_index');
        }

        return $this->render('admin_logo/edit.html.twig', [
            'logo' => $logo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     * @return Response
     */
    public function delete(Request $request, Logo $logo): Response
    {
        if ($this->isCsrfTokenValid('delete' . $logo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($logo);
            $entityManager->flush();
            $this->addFlash('danger', 'L\'entreprise a bien été supprimée');
        }

        return $this->redirectToRoute('admin_logo_index');
    }
}
