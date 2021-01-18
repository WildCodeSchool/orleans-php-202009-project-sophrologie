<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Form\FaqType;
use App\Repository\FaqRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class AdminFaqController
 * @package App\Controller
 * @Route("/admin/faq", name="admin_faq_")
 */
class AdminFaqController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     * @return Response
     */
    public function index(): Response
    {
        $faqs = $this->getDoctrine()
            ->getRepository(Faq::class)
            ->findAll();

        return $this->render(
            'admin_faq/indexAdmin.html.twig',
            [
                'faqs' => $faqs]
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/new",  name="new")
     */
    public function new(Request $request): Response
    {
        $faq = new Faq();
        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($faq);
            $entityManager->flush();
            return $this->redirectToRoute('admin_faq_index');
        }
        return $this->render('admin_faq/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
