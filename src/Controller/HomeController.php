<?php

namespace App\Controller;

use App\Entity\Speciality;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        $specialities = $this->getDoctrine()
            ->getRepository(Speciality::class)
            ->findAll();
        return $this->render('home/index.html.twig', [
            'specialities' => $specialities
        ]);
    }
}
