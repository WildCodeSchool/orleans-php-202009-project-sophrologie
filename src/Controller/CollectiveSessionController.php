<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/collective/session", name="collective_session")
 */
class CollectiveSessionController extends AbstractController
{
    /**
     * @Route("/", name="collective_session_index")
     */
    public function index(): Response
    {
        return $this->render('collective_session/index.html.twig', [
        ]);
    }
}
