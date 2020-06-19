<?php

namespace MobileapiBundle\Controller;

use EvenementBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ComentaireMObileController extends Controller
{
    public function AllCommentsAction($id)
    {
        $comments = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Commentaire")->findBy(array('idevenement'=>$id));
        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($comments);
        return new JsonResponse($formated);
    }

    public function FindCommentByUserAction($idu,$ide)
    {
        $comments = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Commentaire")->findBy(array('id_user'=>$idu,'idevenement'=>$ide));
        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($comments);
        return new JsonResponse($formated);
    }

    public function FindCommentByIDAction($id)
    {
        $comments = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Commentaire")->find($id);
        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($comments);
        return new JsonResponse($formated);
    }
    function filterwords($text){
        $filterWords = array('fuck', 'nike', 'pute','bitch');
        $filterCount = sizeof($filterWords);
        for ($i = 0; $i < $filterCount; $i++) {
            $text = preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('*', strlen($matches[0]));}, $text);
        }
        return $text;
    }
    public function newCommentAction(Request $request,$ide,$idu)
    {
        $em = $this->getDoctrine()->getManager();
        $comments = new Commentaire();
        $event = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Evenement")->find($ide);
        $user = $this->getDoctrine()->getManager()->getRepository("UserBundle:User")->find($idu);
        $comments->setCommentaire($this->filterwords($request->get('commentaire')));
        $comments->setIdUser($user);
        $comments->setIdevenement($event);
        $date = (date('Y-m-d'));

        $comments->setDateC($date);
        $em->persist($comments);
        $em->flush();

        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize($comments);
        return new JsonResponse($formated);
    }

    public function UpdateCommentAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $comments = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Commentaire")->find($id);


        $comments->setCommentaire($this->filterwords($request->get('commentaire')));
        $em->persist($comments);
        $em->flush();

        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize("ok");
        return new JsonResponse($formated);
    }

    public function deleteCommentAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $comments = $this->getDoctrine()->getManager()->getRepository("EvenementBundle:Commentaire")->find(array('id'=>$id));
        $em->remove($comments);
        $em->flush();

        $serializer = new Serializer( [new ObjectNormalizer()]);
        $formated = $serializer->normalize("ok");
        return new JsonResponse($formated);
    }

}
