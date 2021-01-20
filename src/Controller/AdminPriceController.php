<?php

namespace App\Controller;

use App\Entity\Price;
use App\Form\PriceType;
use App\Repository\PriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/price", name="admin_prices_")
 */
class AdminPriceController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PriceRepository $priceRepository
     * @return Response
     */
    public function index(PriceRepository $priceRepository): Response
    {
        return $this->render('admin_price/index.html.twig', [
            'prices' => $priceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $price = new Price();
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($price);
            $entityManager->flush();

            $this->addFlash('success', 'Le tarif a bien été ajouté');


            return $this->redirectToRoute('admin_prices_index');
        }

        return $this->render('admin_price/new.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Price $price
     * @return Response
     */
    public function edit(Request $request, Price $price): Response
    {
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le tarif a bien été modifié');

            return $this->redirectToRoute('admin_prices_index');
        }

        return $this->render('admin_price/edit.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Price $price
     * @return Response
     */
    public function delete(Request $request, Price $price): Response
    {
        if ($this->isCsrfTokenValid('delete' . $price->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($price);
            $entityManager->flush();

            $this->addFlash('success', 'Le tarif a bien été supprimé');
        }

        return $this->redirectToRoute('admin_prices_index');
    }
}
