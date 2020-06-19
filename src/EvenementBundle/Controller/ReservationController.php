<?php


namespace EvenementBundle\Controller;


use EvenementBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller
{

    public function AjoutReservationAction( \Symfony\Component\HttpFoundation\Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $resevation = new Reservation();

        $Evenement = $em->getRepository("EvenementBundle:Evenement")->find(array('id'=>$id));
        $Evenement->setNbrplace($Evenement->getNbrplace()-1);
        $resevation->setIdevenement($Evenement);
        $date = (date('Y-m-d'));
        $resevation->setDateRes($date);
        $user = $em->getRepository('UserBundle:User')->find(array("id"=>$this->getUser()->getId()));
        $resevation->setIdUser($user);
        $em->persist($Evenement);
        $em->persist($resevation);
            $em->flush();
            return $this->redirectToRoute('Page_Parent');


    }


    public function AfficheReservationAdminAction()
    {
        $m = $this->getDoctrine()->getManager();
        $Evenement = $m->getRepository("EvenementBundle:Reservation")->findAll();
        return $this->render('EvenementBundle:Reservation:AfficherReservationAdmin.html.twig', array(
            'event' => $Evenement
        ));
    }

    public function deleteReservationAdminAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $Evenement = $em->getRepository("EvenementBundle:Reservation")->find($id);
        $em->remove($Evenement);
        $em->flush();

        return $this->redirectToRoute('Reservation_AfficheAdmin');
    }

    public function ListeReservationClientAction()
    {

        $m = $this->getDoctrine()->getManager();
        $reservation = $m->getRepository("EvenementBundle:Reservation")->findBy(array("idUser"=>$this->getUser()->getId()));

        return $this->render('EvenementBundle:Reservation:AfficherReservationClient.html.twig', array(
            'reservation'=>$reservation
        ));
    }


    public function deleteReservationClientAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $Evenement = $em->getRepository("EvenementBundle:Reservation")->find($id);
        $idc= $this->getUser()->getId();

        $em->remove($Evenement);
        $em->flush();
        return $this->redirectToRoute('Page_Parent');
    }


}