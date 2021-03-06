<?php

namespace App\AppBundle\Controller;

use App\AppBundle\Managers\PageManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use App\AppBundle\Entity\Page;
use Symfony\Component\HttpFoundation\Response;

/**
 * PagesController
 */
class PageController extends Controller
{
    /**
     * @param int $id
     *
     * @return Response
     */
    public function indexAction($id): Response
    {
        /* @var PageManager $pageManager */
        $pageManager = $this->get('app.managers.page_manager');
        /* @var Page $page */
        if(!$page = $pageManager->getById($id)) {
            throw $this->createNotFoundException();
        }

        return $this->render('AppBundle:Page:index.html.twig', [
            'page' => $page
        ]);
    }
}
