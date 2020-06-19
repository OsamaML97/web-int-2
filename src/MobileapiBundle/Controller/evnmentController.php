<?php

namespace MobileapiBundle\Controller;

use EvenementBundle\Entity\Evenement;
use EvenementBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class evnmentController extends Controller
{
    public function AllEvenementAction()
    {
        $evenements = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Evenement")->findAll();
        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($evenements);
        return new JsonResponse($formated);
    }

    public function ParticiperAction(Request $request,$ide,$idu)
    {
        $em = $this->getDoctrine()->getManager();
        $participe = new Reservation();
        $event = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Evenement")->find($ide);
        $user = $this->getDoctrine()->getManager()->getRepository("UserBundle:User")->find($idu);
        $date = (date('Y-m-d'));
        $participe->setDateRes($date);
        $participe->setIdUser($user);
        $participe->setIdevenement($event);
        $em->persist($event);
        $em->persist($participe);
        $em->flush();


        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($participe);
        return new JsonResponse($formated);
    }

    public function FindParticiperAction($ide,$idu)
    {
        $participe = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Reservation")->findBy(array('idevenement'=>$ide,'idUser'=>$idu));
        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($participe);
        return new JsonResponse($formated);
    }

    public function FindParticiperAllAction()
    {
        return $this->render('MobileapiBundle:evnment:find_participer_all.html.twig', array(
            // ...
        ));
    }

    public function deleteParticiperAction(Request $request,$idu,$ide)
    {
        $em=$this->getDoctrine()->getManager();
        $participe = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Reservation")->findOneBy(array('idevenement'=>$ide,'idUser'=>$idu));
        $event = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Evenement")->find($participe->getIdevenement()->getId());

        $em->persist($event);
        $em->remove($participe);
        $em->flush();

        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize("ok");
        return new JsonResponse($formated);
    }
    public function rateAction(\Symfony\Component\HttpFoundation\Request $request){


        $em = $this->getDoctrine()->getManager();
        $rate =$request->get('rate');
        $idc = $request->get('evenement');
        $Evenement = $em->getRepository("EvenementBundle:Evenement")->find($idc);
        $note = ($Evenement->getRate()*$Evenement->getVote() + $rate)/($Evenement->getVote()+1);
        $Evenement->setVote($Evenement->getVote()+1);
        $Evenement->setRate($note);
        $em->persist($Evenement);
        $em->flush();
        return new Response("Done");
    }
    public function StatAction()
    {
        $statistique=$this->getDoctrine()->getRepository(Evenement::class)->statistique_participer();

        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($statistique);
        return new JsonResponse($formated);
    }
}
