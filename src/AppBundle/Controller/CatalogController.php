<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CatalogController extends Controller
{
    public function indexAction($id = 0)
    {
        return $this->render('AppBundle:Catalog:index.html.twig', []);
    }
}
