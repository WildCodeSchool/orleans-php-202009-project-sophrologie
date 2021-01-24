<?php

namespace App\Controller;

use App\Repository\LogoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Logo;

/**
 * @Route("/collective/session", name="collective_session_")
 */
class CollectiveSessionController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(LogoRepository $logoRepository): Response
    {
        return $this->render('collective_session/index.html.twig', [
            'logos' => $logoRepository->findAll(),
        ]);
    }
}
