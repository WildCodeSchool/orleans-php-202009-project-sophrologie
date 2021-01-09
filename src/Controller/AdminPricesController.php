<?php

namespace App\Controller;

use App\Entity\Prices;
use App\Form\PricesType;
use App\Repository\PricesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/prices", name="admin_prices_")
 */
class AdminPricesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PricesRepository $pricesRepository
     * @return Response
     */
    public function index(PricesRepository $pricesRepository): Response
    {
        return $this->render('admin_prices/index.html.twig', [
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
        $price = new Prices();
        $form = $this->createForm(PricesType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($price);
            $entityManager->flush();

            $this->addFlash('success', 'Le tarif à bien était ajouté');


            return $this->redirectToRoute('prices_index');
        }

        return $this->render('admin_prices/new.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }
}
