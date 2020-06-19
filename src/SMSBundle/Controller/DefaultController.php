<?php

namespace SMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/smst")
     */
    public function indexAction()
    {
        return $this->render('SMSBundle:Default:index.html.twig');
    }
}
