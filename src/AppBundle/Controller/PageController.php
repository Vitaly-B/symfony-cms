<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Page;

class PageController extends Controller
{
    public function indexAction($id)
    {
        /* @var EntityManager $em */
        $em = $this->get('doctrine.orm.default_entity_manager');
        /* @var Page $page */
        if(!$page = $em->getRepository(Page::class)->find($id)) {
            throw $this->createNotFoundException();
        }

        return $this->render('AppBundle:Page:index.html.twig', [
            'page' => $page
        ]);
    }
}
