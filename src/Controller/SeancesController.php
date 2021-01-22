<?php

namespace App\Controller;

use App\Repository\PriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeancesController extends AbstractController
{
    /**
     * @Route("/seances", name="seances")
     * @param PriceRepository $priceRepository
     * @return Response
     */
    public function index(PriceRepository $priceRepository): Response
    {
        return $this->render('seances/index.html.twig', [
            'prices' => $priceRepository->findAll(),
        ]);
    }
}
