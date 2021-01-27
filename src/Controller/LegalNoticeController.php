<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticeController extends AbstractController
{
    /**
     * @Route("/mention/", name="mention")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('mention/index.html.twig');
    }
}
