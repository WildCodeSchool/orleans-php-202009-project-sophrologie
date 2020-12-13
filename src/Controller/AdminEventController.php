<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use app\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/event", name="admin_event_")
 */
class AdminEventController extends AbstractController
{

    /**
     * @Route("/new", name="new")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute('admin_new');
        }

        return $this->render('admin_event/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Event $event, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_event_new');
        }

        return $this->render('admin_event/edit.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
        ]);
    }



    /**
     * @Route("/admin/event/index", name="admin_event")
     */
    public function index(): Response
    {
        return $this->render('admin_event/new.html.twig', [
            'controller_name' => 'AdminEventController',
        ]);
    }
}
