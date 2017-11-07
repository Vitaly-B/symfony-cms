<?php

namespace App\AppBundle\Controller;

use App\AppBundle\Entity\Product;
use App\AppBundle\Managers\FilterManager;
use App\AppBundle\Managers\ProductCategoryManager;
use App\AppBundle\Managers\ProductManager;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ProductController
 */
class ProductController extends Controller
{
    /**
     * @param Request  $request
     * @param int      $page
     * @param int|null $categoryId
     *
     * @return Response
     */
    public function indexAction(Request $request, int $page = 1, ?int $categoryId = null): Response
    {

        /* @var ProductManager $productManager */
        $productManager = $this->get('app.managers.product_manager');

        $productCategory = null;

        if($categoryId) {
            /* @var ProductCategoryManager $productCategoryManager */
            $productCategoryManager = $this->get('app.managers.product_category_manager');
            if(!$productCategory = $productCategoryManager->getById($categoryId)) {
                throw $this->createNotFoundException();
            }
        }

        $productManager->setProductCategory($productCategory);
        $productManager->getFilterForm()->handleRequest($request);

        /* @var Pagerfanta $products */
        $products = $productManager->getPager($page);

        return $this->render('AppBundle:Product:index.html.twig', ['products' => $products, 'categoryId' => $categoryId]);
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
