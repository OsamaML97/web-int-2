<?php


namespace EvenementBundle\Controller;


use EvenementBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentaireController extends  Controller
{
    public function AfficheAddCommentAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = new Commentaire();
        $event = $em->getRepository("EvenementBundle:Evenement")->find(array("id" => $id));

        $Comm = $em->getRepository("EvenementBundle:Commentaire")->findBy(array("idevenement" => $id));
        $date = (date('Y-m-d'));
        $comment->setDateC($date);
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $comment->setIdUser($user);
        $comment->setIdevenement($event);

        $form = $this->createForm('EvenementBundle\Form\CommentaireType', $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('Comment', ['id' => $id]);
        }
        return $this->render('@Evenement/Commentaire/Comment.html.twig', array(
            'form' => $form->createView(),
            'comment' => $Comm,
            'event' => $event,


        ));

    }


    public function editCommentaireAction(Request $request, $idc,$ide)
    {
        $em = $this->getDoctrine()->getManager();

        $comentaire = $em->getRepository('EvenementBundle:Commentaire')->find($idc);
        $editForm = $this->createForm('EvenementBundle\Form\CommentaireType', $comentaire);
        $event = $em->getRepository("EvenementBundle:Evenement")->find(array("id" => $ide));
        $Comm = $em->getRepository("EvenementBundle:Commentaire")->findBy(array("idevenement" => $idc));

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($comentaire);
            $em->flush();

            return $this->redirectToRoute('Comment', ['id' => $ide]);
        }

        return $this->render('@Evenement/Commentaire/Comment.html.twig', array(
            'comm' => $comentaire,
            'event' => $event,
            'comment' => $Comm,
            'form' => $editForm->createView(),
        ));
    }

    public function deleteCommentAction(Request $request,$ide,$idc)
    {

        $em = $this->getDoctrine()->getManager();

        $Evenement = $em->getRepository("EvenementBundle:Commentaire")->find($idc);
        $em->remove($Evenement);
        $em->flush();

        return $this->redirectToRoute('Comment', ['id' => $ide]);
    }
}