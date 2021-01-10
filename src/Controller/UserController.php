<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/admin/user", name="admin_user_")
 */
class UserController extends AbstractController
{


    /**
     *
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin_user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
