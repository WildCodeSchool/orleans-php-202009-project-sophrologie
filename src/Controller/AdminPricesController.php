<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPricesController extends AbstractController
{
    /**
     * @Route("/admin/prices", name="admin_prices")
     */
    public function index(): Response
    {
        return $this->render('admin_prices/index.html.twig', [
            'controller_name' => 'AdminPricesController',
        ]);
    }
}
