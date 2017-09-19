<?php

namespace AppBundle\Controller;

use AppBundle\Managers\PageManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Page;

class PagesController extends Controller
{
    public function indexAction($id)
    {
        /* @var PageManager $em */
        $pageManager = $this->get('app.page_manager');
        /* @var Page $page */
        if(!$page = $pageManager->getById($id)) {
            throw $this->createNotFoundException();
        }

        return $this->render('AppBundle:Page:index.html.twig', [
            'page' => $page
        ]);
    }
}
