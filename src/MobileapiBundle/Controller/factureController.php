<?php

namespace MobileapiBundle\Controller;

use FactureBundle\Entity\Facture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class factureController extends Controller
{
    public function ADDFactureAction(Request $request)
    {
        $fact = new Facture();
        $fact->setEtat("non paye");
        $fact->setIdU((int)$request->get('idU'));
        $date=new \DateTime();
        $datefin=date_add($date, date_interval_create_from_date_string('90 days'));
        $fact->setDelais($datefin);
        $fact->setMontant(900);
        $em = $this->getDoctrine()->getManager();
        $em->persist($fact);
        $em->flush();
        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($fact);
        return new JsonResponse($formated);
    }

    public function ALLFactureAction()
    {
        $em = $this->getDoctrine()->getManager();
        $factures =$em->getRepository("FactureBundle:Facture")->findAll();
        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($factures);
        return new JsonResponse($formated);
    }

    public function PayeFactureAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository("FactureBundle:Facture")->find((int)$request->get('id'));
        $facture->setEtat("payee");

        $em = $this->getDoctrine()->getManager();
        $em->persist($facture);
        $em->flush();
        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($facture);
        return new JsonResponse($formated);
    }

}
