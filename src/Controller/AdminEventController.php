<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/admin/event", name="admin_event_")
 */
class AdminEventController extends AbstractController
{
    /**
     *
     * @Route("/index", name="index")
     */

    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findArchive(false);
        $eventsArchive = $eventRepository->findArchive(true);

        return $this->render('admin_event/index.html.twig', [
            'events' => $events,
            'eventsArchive' => $eventsArchive,

        ]);
    }

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
            return $this->redirectToRoute('admin_event_index');
        }

        return $this->render('admin_event/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @ParamConverter("event", class="App\Entity\Event", options={"mapping": {"id": "id"}})
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_event_index');
        }

        return $this->render('admin_event/edit.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     * @return Response
     */


    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete' . $event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_event_index');
    }

    /**
     * @Route("/archive/{id}", name="archive", methods={"POST"})
     * @ParamConverter("event", class="App\Entity\Event", options={"mapping": {"id": "id"}})
     */
    public function archive(Request $request, Event $event): Response
    {

        if ($this->isCsrfTokenValid('archive' . $event->getId(), $request->request->get('_token'))) {
            $event-> setArchive(true);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_event_index');
        }

        return $this->redirectToRoute('admin_event_index');
    }

    /**
     * @Route("/republish/{id}", name="republish", methods={"POST"})
     * @ParamConverter("event", class="App\Entity\Event", options={"mapping": {"id": "id"}})
     */
    public function republish(Request $request, Event $event): Response
    {

        if ($this->isCsrfTokenValid('republish' . $event->getId(), $request->request->get('_token'))) {
            $event-> setArchive(false);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_event_index');
        }

        return $this->redirectToRoute('admin_event_index');
    }
}
