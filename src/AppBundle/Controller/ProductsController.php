<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Managers\ProductManager;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    /**
     * @param int $page
     * @param int|null $categoryId
     *
     * @return Response
     */
    public function indexAction(int $page = 1, ?int $categoryId = null)
    {
        /* @var ProductManager $productManager */
         $productManager = $this->get('app.product_manager');

        /* @var Pagerfanta|Product[] $products */
        $products = $productManager->getPage($page, []);

        return $this->render('AppBundle:Catalog:index.html.twig', ['products' => $products]);
    }
}
