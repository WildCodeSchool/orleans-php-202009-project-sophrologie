<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\ReportRepository;
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
     * @param ReportRepository $reportRepository
     * @return Response
     * @IsGranted("ROLE_USER")
     * @Route("/mon-compte/", name="user")
     */
    public function myAccount(Request $request, ReportRepository $reportRepository): Response
    {
        $form = $this->createForm(UserType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Vos modifications ont bien été mises à jour !');
        }

        $user = $this->getUser();

        return $this->render('user/account.html.twig', [
            'formEditUser' => $form->createView(),
            'reports' => $reportRepository->findBy([
                'patient' => $user
            ])
        ]);
    }
}
