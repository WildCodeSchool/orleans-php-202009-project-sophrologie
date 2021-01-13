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
     * @param PriceRepository $pricesRepository
     * @return Response
     */
    public function index(PriceRepository $pricesRepository): Response
    {
        return $this->render('admin_price/index.html.twig', [
            'prices' => $pricesRepository->findAll(),
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

            $this->addFlash('success', 'Le tarif à bien était ajouté');


            return $this->redirectToRoute('admin_prices_index');
        }

        return $this->render('admin_price/new.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }
}
