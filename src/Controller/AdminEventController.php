<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\EventSearch;
use App\Form\EventType;
use App\Form\SearchAdminEventType;
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

    public function index(Request $request, EventRepository $eventRepository): Response
    {
        $eventSearch = new EventSearch();
        $form = $this->createForm(SearchAdminEventType::class, $eventSearch);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $events = $eventRepository->findLikeName($eventSearch);
            $eventsArchive = $eventRepository->findLikeName($eventSearch);
        }


        return $this->render('admin_event/index.html.twig', [
            'events' => $events ?? $eventRepository->findBy(['archive' => 0], ['eventdate' => 'DESC']),
            'eventsArchive' => $eventsArchive ?? $eventRepository->findBy(['archive' => 1], ['eventdate' => 'DESC']),
            'form' => $form->createView(),
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
     */
    public function togglearchive(Request $request, Event $event): Response
    {

        if ($this->isCsrfTokenValid('archive' . $event->getId(), $request->request->get('_token'))) {
            $event->setArchive(!$event->getArchive());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_event_index');
        }

        return $this->redirectToRoute('admin_event_index');
    }
}
