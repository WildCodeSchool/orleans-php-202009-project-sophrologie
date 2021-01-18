<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AdminUser extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @param User $user
     * @return Response
     * @IsGranted("ROLE_USER", statusCode=404)
     * @Route("/mon-compte/{firstname}/{lastname}", name="user")
     */
    public function myAccount(User $user): Response
    {
        return $this->render('user/account.html.twig');
    }
}
