<?php


namespace EvenementBundle\Controller;


use EvenementBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller

{

    public function count()
    {
        $count = 0;
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getRepository("EvenementBundle:Evenement")->findAll();
        foreach ($Evenement as $e){
            $count = $count + 1;
        }

        return $count;

    }
    public function AjoutEvenementAction( \Symfony\Component\HttpFoundation\Request $request)
    {
        $count = $this->count();
        $em = $this->getDoctrine()->getManager();
        $evenment = new Evenement();
        $form = $this->createForm('EvenementBundle\Form\EvenementType', $evenment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($evenment);
            $em->flush();
            return $this->redirectToRoute('evenement_Affiche');
        }
        return $this->render('@Evenement/Evenement/AjouterEvenement.html.twig', array(
            'form' => $form->createView(),
            'count' => $count,
        ));
    }


    public function AfficheEvenementAction()
    {
        $count = $this->count();
        $m = $this->getDoctrine()->getManager();
        $Evenement = $m->getRepository("EvenementBundle:Evenement")->findAll();
        return $this->render('EvenementBundle:Evenement:AfficheEvenement.html.twig', array(
            'event' => $Evenement,
            'count' => $count,
        ));
    }

    public function deleteEventAction($id)
    {
        $count = $this->count();
        $em = $this->getDoctrine()->getManager();

        $Evenements = $em->getRepository("EvenementBundle:Evenement")->find($id);
        $Evenement = $em->getRepository("EvenementBundle:Evenement")->findAll();

        $em->remove($Evenements);
        $em->flush();

        return $this->redirectToRoute('evenement_Affiche');

    }

    public function editEvenementAction(Request $request, $id)
    {
        $count = $this->count();
        $em = $this->getDoctrine()->getManager();
        $Evenements = $em->getRepository("EvenementBundle:Evenement")->findAll();

        $evenement = $em->getRepository('EvenementBundle:Evenement')->find($id);
        $editForm = $this->createForm('EvenementBundle\Form\EvenementType', $evenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($evenement);
            $em->flush();

            //return $this->redirectToRoute('evenement_Affiche');
            return $this->render('EvenementBundle:Evenement:AfficheEvenement.html.twig', array(
                'count' => $count,
                'event'=> $Evenements
            ));
        }

        return $this->render('EvenementBundle:Evenement:editEvenement.html.twig', array(
            'event' => $evenement,
            'form' => $editForm->createView(),
            'count' => $count,
        ));
    }

    public function rateAction(\Symfony\Component\HttpFoundation\Request $request){
        $data = $request->getContent();
        $obj = json_decode($data,true);

        $em = $this->getDoctrine()->getManager();
        $rate =$obj['rate'];
        $idc = $obj['Evenement'];
        $animateur = $em->getRepository("EvenementBundle:Evenement")->find($idc);
        $note = ($animateur->getRate()*$animateur->getVote() + $rate)/($animateur->getVote()+1);
        $animateur->setVote($animateur->getVote()+1);
        $animateur->setRate($note);
        $em->persist($animateur);
        $em->flush();
        return new Response($animateur->getRate());
    }



}