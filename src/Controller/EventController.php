<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Event;
use App\Form\SearchEventFormType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/actualités", name="event_")
 */
class EventController extends AbstractController
{

    /**
     * Show all rows from Event’s entity
     * @Route("/", name="index")
     * @param EventRepository $eventRepository
     * @param Request $request
     * @return Response A response instance
     */
    public function index(EventRepository $eventRepository, Request $request): Response
    {

        $form = $this->createForm(SearchEventFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->getData()['searchcategory']->count() != 0) {
            $searchcategory = $form->getData()['searchcategory'];
            $events = $eventRepository->findBy(['category' => $searchcategory->toArray(),
                'archive' => 0], ['eventdate' => 'DESC']);
        } else {
            $events = $eventRepository->findBy(['archive' => 0], ['eventdate' => 'DESC']);
        }
        return $this->render('event/index.html.twig', [
            'events' => $events,
            'form' => $form->createView()
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
