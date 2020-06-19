<?php

namespace EventBundle\Controller;

use EventBundle\Entity\Event;
use EventBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    public function ajoutEventAction(Request $request)
    {

      $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->HandleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('event_afficheEvent');

        }

        return $this->render("@Event/Event/ajoutEvent.html.twig", array('form' => $form->createView()));

    }

    public function afficheEventAction()
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository("EventBundle:Event")->findAll();

        return $this->render('@Event/Event/AfficheEvent.html.twig', array(
            'event' => $event));


    }

    public function afficheEventGuestAction()
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository("EventBundle:Event")->findAll();

        return $this->render('@Event/Event/AfficheEventGuest.html.twig', array(
            'event' => $event));


    }

    public function supprimerEventAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute("event_afficheEvent");


    }

    public function editAction(Request $request, Event $event)
    {
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_afficheEvent');


        }

        return $this->render('@Event/Event/EditEvent.html.twig', [
            'form' => $form->createView()
        ]);

    }

}
