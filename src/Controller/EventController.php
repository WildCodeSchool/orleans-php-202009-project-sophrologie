<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event", name="event_")
 */

class EventController extends AbstractController
{

    /**
     * Show all rows from Event’s entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findBy(['archive' => 0], ['eventdate' => 'DESC']);
        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * @Route("/{id}/", methods={"GET"}, name="show")
     */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }
}
