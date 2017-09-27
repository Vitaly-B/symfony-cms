<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Managers\FilterManager;
use AppBundle\Managers\ProductCategoryManager;
use AppBundle\Managers\ProductManager;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * ProductController
 */
class ProductController extends Controller
{
    /**
     * @param int      $page
     * @param int|null $categoryId
     *
     * @return Response
     */
    public function indexAction(int $page = 1, ?int $categoryId = null): Response
    {

        /* @var ProductManager $productManager */
         $productManager = $this->get('app.managers.product_manager');
         /* @var FilterManager $filterManager*/
         $filterManager = $this->get('app.managers.filter_manager');

        $productCategory = null;

        if($categoryId) {
            /* @var ProductCategoryManager $productCategoryManager */
            $productCategoryManager = $this->get('app.managers.product_category_manager');
            if(!$productCategory = $productCategoryManager->getById($categoryId)) {
                throw $this->createNotFoundException();
            }
        }

        $productManager->setProductCategory($productCategory);
        $productManager->setFilter($this->get('app.managers.filter_manager')->getFilter());

        /* @var Pagerfanta $products */
        $products = $productManager->getProducts($page);

        return $this->render('AppBundle:Product:index.html.twig', ['products' => $products]);
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(int $id): Response
    {
        /* @var ProductManager $productManager */
        $productManager = $this->get('app.managers.product_manager');

        /* @var Product $product */
        if(!$product = $productManager->getById($id)) {
            throw $this->createNotFoundException();
        }

        return $this->render('AppBundle:Product:view.html.twig', ['product' => $product]);
    }
}
