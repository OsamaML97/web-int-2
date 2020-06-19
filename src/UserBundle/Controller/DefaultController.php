<?php

namespace UserBundle\Controller;

use Proxies\__CG__\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
    public function ParentAction()
    {

        $m = $this->getDoctrine()->getManager();
        $Evenement = $m->getRepository("EvenementBundle:Evenement")->findAll();
        $reservation = $m->getRepository("EvenementBundle:Reservation")->findAll();

        $user = $m->getRepository('UserBundle:User')->find(array("id"=>$this->getUser()->getId()));
        return $this->render('UserBundle::Page_Parent.html.twig', array(
            'event' => $Evenement,
            'user'=> $user,
            'reservation'=>$reservation
        ));
    }
    public function ResponsableAction()
    {
        return $this->render('UserBundle::Page_Responsable.html.twig');
    }
    public function AdminAction()
    {

        $count = 0;
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getRepository("EvenementBundle:Evenement")->findAll();
        foreach ($Evenement as $e){
            $count = $count + 1;
        }

       //return $this->render('UserBundle::Page_Admin.html.twig');
        return $this->render('UserBundle::Page_Admin.html.twig', array(
            'count' => $count,
        ));
    }

    public function infoUserAction()
    {

        $user=$this->container->get('security.token_storage')->getToken()->getUser();

        //return $this->render('UserBundle::Page_Admin.html.twig');
        return $this->render('@User/Parent/info_parent.html.twig', array(
            'user' => $user,
        ));
    }
    public function List_UserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("UserBundle:User")->findAll();
$factures =$em->getRepository("FactureBundle:Facture")->findAll();

        return $this->render('@User/Admin/List_users.html.twig', array(
            'users' => $users,'factures'=>$factures
        ));
    }

    public function Desactiver_UserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $u = new User();

        $user = $em->getRepository("UserBundle:User")->find($id);
        $user ->setEnabled(fALSE);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute("List_users");
    }
    public function Facture_UserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->container->get('security.token_storage')->getToken()->getUser();
        $factures =$em->getRepository("FactureBundle:Facture")->findAll();

        return $this->render('@User/Parent/mes_Factures.html.twig', array(
            'user' => $user,'factures'=>$factures
        ));
    }

    public function Activer_UserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("UserBundle:User")->find($id);

        $user ->setEnabled(True);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute("List_users");
    }

}
