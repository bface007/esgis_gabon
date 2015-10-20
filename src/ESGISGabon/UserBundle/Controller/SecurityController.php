<?php

namespace ESGISGabon\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends \FOS\UserBundle\Controller\SecurityController
{
    protected function renderLogin(array $data)
    {
        return $this->render('ESGISGabonUserBundle:Security:login.html.twig', $data);
    }
}
