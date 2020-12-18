<?php

namespace App\Controller;

use App\Entity\Speciality;
use App\Form\SpecialityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('admin/layoutAdmin.html.twig');
    }
}
