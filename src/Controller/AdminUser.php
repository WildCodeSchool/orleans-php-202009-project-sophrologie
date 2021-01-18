<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AdminUser extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     * @IsGranted("ROLE_USER", statusCode=404)
     * @Route("/mon-compte/{firstname}/{lastname}", name="user")
     */
    public function myAccount(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Vos modifications ont bien été mises à jour !');
        }

        return $this->render('user/account.html.twig', [
            'user' => $user,
            'formEditUser' => $form->createView(),
        ]);
    }
}
