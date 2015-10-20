<?php

namespace ESGISGabon\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BackendController extends Controller
{
    public function indexAction()
    {
        return $this->render('ESGISGabonMainBundle:Backend:home.html.twig', array(
            'page_title' => 'Tableau de bord',
            'page_subtitle' => 'Statistiques et rapports'
        ));
    }

    
}
