<?php

namespace EnfantsBundle\Controller;

use EnfantsBundle\Entity\Enfants;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EnfantsBundle\Form\EnfantsType;
use Symfony\Component\HttpFoundation\Request;
use OC\PlatformBundle\Form\AdvertType;
use Ob\HighchartsBundle\Highcharts\Highchart;


class EnfantController extends Controller
{
    public function ajoutEnfantsAction(Request $request)
    {
        $enfant = new Enfants();
        $form = $this->createForm(EnfantsType::class, $enfant);
        $form->HandleRequest($request);

        if ($request->getMethod()=='POST'){
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($enfant);
                $em->flush();
                return $this->redirectToRoute('enfants_afficheEnfants');
            }
        }



        return $this->render("@Enfants/Enfant/AjoutEnfant.html.twig", array('form' => $form->createView()));
    }

    public function afficheEnfantAction()
    {
        $em = $this->getDoctrine()->getManager();

        $enfant = $em->getRepository("EnfantsBundle:Enfants")->findAll();

        return $this->render('@Enfants/Enfant/AfficheEnfant.html.twig', array(
            'enfants' => $enfant));
    }

    public function afficheEnfantGuestAction()
    {
        $em = $this->getDoctrine()->getManager();

        $enfant = $em->getRepository("EnfantsBundle:Enfants")->findAll();

        return $this->render('@Enfants/Enfant/AfficheEnfantGuest.html.twig', array(
            'enfants' => $enfant));


    }


    public function supprimerEnfantAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $enfant = $em->getRepository(Enfants::class)->find($id);
        $em->remove($enfant);
        $em->flush();
        return $this->redirectToRoute("enfants_afficheEnfants");



    }

    public function editAction(Request $request, Enfants $enfant)
    {
        $form = $this->createForm(EnfantsType::class, $enfant);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('enfants_afficheEnfants');


        }

        return $this->render('@Enfants/Enfant/EditEnfant.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function obAction()
    {

        //var_dump($nbr);
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Enfants');
        $ob->plotOptions->pie(array('allowPointSelect' => true, 'cursor' => 'pointer', 'dataLabels' => array('enabled' => false),
            'showInLegend' => true));
        // $em = $this->container->get('doctrine')->getEntityManager();
        $em=$this->getDoctrine()->getManager();

        $enfant = $em->getRepository('EnfantsBundle:Enfants')->rechercherEnfantsParSexe();

        $enfants_array = json_decode(json_encode($enfant),true);


        var_dump($enfants_array);
        $nbr = count($enfant);
//        $o = '55';
//        $oo = intval($o*100);

//        var_dump($oo);
        $data = array();

        $j = 0;
        while($j < $nbr) {

            var_dump($j);

            $stat = array();
            // var_dump($fiches[$j]["etat"]);$fiches[$j]["nombre"];

//            $nbr_people = intval($enfants[$j]["nombre"]);

            array_push($stat, "Le sexe : " . $enfants_array[$j]["sexe"], intval($enfants_array[$j]["nombre"]));
            //var_dump($stat);
            array_push($data, $stat);

            //var_dump($stat);


            $j++;

        }




        var_dump($data);
        $ob->series(array(array('type' => 'pie', 'name' => 'Leur nombre est de : ', 'data' => $data)));
        return $this->render('@Enfants/Enfant/statistic.html.twig', array('chart' => $ob));
    }

    public function ob2Action()
    {
        // Chart
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Enfants');
        $ob->plotOptions->pie(array('allowPointSelect' => true, 'cursor' => 'pointer', 'dataLabels' => array('enabled' => false),
            'showInLegend' => true));
        // $em = $this->container->get('doctrine')->getEntityManager();
        $em=$this->getDoctrine()->getManager();

        $enfant = $em->getRepository('EnfantsBundle:Enfants')->rechercherEnfantsParLieu();

        $enfants_array = json_decode(json_encode($enfant),true);


        var_dump($enfants_array);
        $nbr = count($enfant);
//        $o = '55';
//        $oo = intval($o*100);

//        var_dump($oo);
        $data = array();

        $j = 0;
        while($j < $nbr) {

            var_dump($j);

            $stat = array();
            // var_dump($fiches[$j]["etat"]);$fiches[$j]["nombre"];

//            $nbr_people = intval($enfants[$j]["nombre"]);

            array_push($stat, "Le Lieu : " . $enfants_array[$j]["lieuNaissance"], intval($enfants_array[$j]["nombre"]));
            //var_dump($stat);
            array_push($data, $stat);

            //var_dump($stat);


            $j++;

        }




        var_dump($data);
        $ob->series(array(array('type' => 'pie', 'name' => 'Leur nombre est de : ', 'data' => $data)));
        return $this->render('@Enfants/Enfant/statistic2.html.twig', array('chart' => $ob));
    }

    public function ob3Action()
    {
        // Chart
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Enfants');
        $ob->plotOptions->pie(array('allowPointSelect' => true, 'cursor' => 'pointer', 'dataLabels' => array('enabled' => false),
            'showInLegend' => true));
        // $em = $this->container->get('doctrine')->getEntityManager();
        $em=$this->getDoctrine()->getManager();

        $enfant = $em->getRepository('EnfantsBundle:Enfants')->rechercherEnfantsParMed();

        $enfants_array = json_decode(json_encode($enfant),true);


        var_dump($enfants_array);
        $nbr = count($enfant);
//        $o = '55';
//        $oo = intval($o*100);

//        var_dump($oo);
        $data = array();

        $j = 0;
        while($j < $nbr) {

            var_dump($j);

            $stat = array();
            // var_dump($fiches[$j]["etat"]);$fiches[$j]["nombre"];

//            $nbr_people = intval($enfants[$j]["nombre"]);

            array_push($stat, "Le Medicine : " . $enfants_array[$j]["medicin"], intval($enfants_array[$j]["nombre"]));
            //var_dump($stat);
            array_push($data, $stat);

            //var_dump($stat);


            $j++;

        }




        var_dump($data);
        $ob->series(array(array('type' => 'pie', 'name' => 'Leur nombre est de : ', 'data' => $data)));
        return $this->render('@Enfants/Enfant/statisticMed.html.twig', array('chart' => $ob));
    }
    public function rechercheByLieuAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $enfant = $em->getRepository(Enfants::class)->findAll();
        if($request->isMethod("POST"))
        {
            $lieu = $request->get('lieuNaissance');
            $enfant = $em->getRepository('EnfantsBundle:Enfants')->findBy(array('lieuNaissance'=>$lieu),array('nom'=>'ASC'));

        }
        return $this->render('@Enfants/Enfant/recherche.html.twig',array('enfants'=>$enfant));


    }

    public function rechercheByNomAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $enfant = $em->getRepository(Enfants::class)->findAll();
        if($request->isMethod("POST"))
        {
            $nom = $request->get('nom');
            $enfant = $em->getRepository('EnfantsBundle:Enfants')->findBy(array('nom'=>$nom),array('nom'=>'ASC'));

        }
        return $this->render('@Enfants/Enfant/rechercheNom.html.twig',array('enfants'=>$enfant));


    }

    public function rechercheByNomGuestAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $enfant = $em->getRepository(Enfants::class)->findAll();
        if($request->isMethod("POST"))
        {
            $nom = $request->get('nom');
            $enfant = $em->getRepository('EnfantsBundle:Enfants')->findBy(array('nom'=>$nom),array('prenom'=>'ASC'));

        }
        return $this->render('@Enfants/Enfant/rechercheNomGuest.html.twig',array('enfants'=>$enfant));


    }

    public function rechercheByMedicinAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $enfant = $em->getRepository(Enfants::class)->findAll();
        if($request->isMethod("POST"))
        {
            $medicin = $request->get('medicin');
            $enfant = $em->getRepository('EnfantsBundle:Enfants')->findBy(array('medicin'=>$medicin),array('nom'=>'ASC'));

        }
        return $this->render('@Enfants/Enfant/rechercheMedicin.html.twig',array('enfants'=>$enfant));


    }





}
