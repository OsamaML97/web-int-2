<?php


namespace EvenementBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use EvenementBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatistiqueController extends Controller
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
    public function indexAction()
    {
        $count = $this->count();
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $classes = $em->getRepository(Evenement::class)->findAll();
        $nombrePlace=0;
        foreach($classes as $classe) {
            $nombrePlace=$nombrePlace+$classe->getNbrplace();
        }
        $data= array();
        $stat=['Evenement', 'nbrplace'];
        $nb=0;
        array_push($data,$stat);
        foreach($classes as $classe) {
            $stat=array();
            array_push($stat,$classe->getTitre(),(($classe->getNbrplace()) *100)/$nombrePlace);
            $nb=($classe->getNbrplace() *100)/$nombrePlace;
            $stat=[$classe->getTitre(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des Place par Evenement');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('EvenementBundle:Stat:index.html.twig', array('piechart' =>
            $pieChart,
            'count' => $count,
        ));
    }

}