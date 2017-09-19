<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategory;
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
     * @param int $page
     * @param int|null $categoryId
     *
     * @return Response
     */
    public function indexAction(int $page = 1, ?int $categoryId = null): Response
    {
        /* @var ProductManager $productManager */
         $productManager = $this->get('app.product_manager');

        /* @var ProductCategoryManager $productCategoryManager */
        $productCategoryManager = $this->get('app.product_category_manager');

        $category = null;

        if($categoryId) {
            if(!$category = $productCategoryManager->getById($categoryId)) {
                throw $this->createNotFoundException();
            }
        }

        /* @var Pagerfanta $products */
        $products = $productManager->getProducts($page, $category);

        return $this->render('AppBundle:Product:index.html.twig', ['products' => $products, 'category' => $category]);
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(int $id): Response
    {
        /* @var ProductManager $productManager */
        $productManager = $this->get('app.product_manager');

        /* @var Product $product */
        if(!$product = $productManager->getById($id)) {
            throw $this->createNotFoundException();
        }

        return $this->render('AppBundle:Product:view.html.twig', ['product' => $product]);
    }
}
