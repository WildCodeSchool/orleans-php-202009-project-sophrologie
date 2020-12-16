<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminHomeController
 * @package App\Controller
 * @Route("/admin", name="app_admin_")
 */
class AdminHomeController extends AbstractController
{

    /**
     * @return Response
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $sectionAdmins = ["Spécialité","Séance","Témoignage", "Spécialité"];

        return $this->render('admin/layoutAdmin.html.twig', [
            "sections" => $sectionAdmins
        ]);
    }
}
