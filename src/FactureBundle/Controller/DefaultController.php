<?php

namespace FactureBundle\Controller;

use FactureBundle\Entity\Facture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FactureBundle:Default:index.html.twig');
    }

    public function ADD_FactureAction($id)
    {
      $fact = new Facture();
      $fact->setEtat("non paye");
        $fact->setIdU($id);
        $date=new \DateTime();
        $datefin=date_add($date, date_interval_create_from_date_string('90 days'));
        $fact->setDelais($datefin);
        $fact->setMontant(900);
        $em = $this->getDoctrine()->getManager();
        $em->persist($fact);
        $em->flush();
        return $this->redirectToRoute("List_users");
    }
    public function Paye_FactureAction($id)
    {
        $fact = new Facture();
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository("FactureBundle:Facture")->find($id);
        $facture->setEtat("payee");

        $em = $this->getDoctrine()->getManager();
        $em->persist($facture);
        $em->flush();
        return $this->redirectToRoute("Facture_User");
    }
    public function Faire_PDFAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->container->get('security.token_storage')->getToken()->getUser();
        $factures =$em->getRepository("FactureBundle:Facture")->findAll();
        $snappy = $this->get("knp_snappy.pdf");
        $html=$this->renderView(
        // app/Resources/views/Emails/registration.html.twig
            'default/PDF.html.twig',
            array(

                'factures'=>$factures,
                'user'=>$user,


            )


        );
        $fileName = "Factures";
        return new Response($snappy->getOutputFromHtml($html),200,array('Content-Type' => 'application/pdf','Content-Disposition' => 'attachment; filename="'.$fileName.'.pdf"'));

    }
}
