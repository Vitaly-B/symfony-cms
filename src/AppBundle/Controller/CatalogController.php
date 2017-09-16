<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CatalogController extends Controller
{
    public function indexAction($categoryId, $page)
    {
        return $this->render('AppBundle:Catalog:index.html.twig', []);
    }
}
