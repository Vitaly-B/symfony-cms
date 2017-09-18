<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategory;
use AppBundle\Managers\ProductCategoryManager;
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

         /* @var int[] $categoryIds */
         $categoryIds = [];

         if($categoryId) {

             $categoryIds[] = $categoryId;

             /* @var ProductCategoryManager $productCategoryManager */
             $productCategoryManager = $this->get('app.product_category_manager');
             /* @var ProductCategory[] $productCategoryArr*/
             $productCategoryArr = $productCategoryManager->getCategoryHierarchy($categoryId);

             array_walk($productCategoryArr, function(ProductCategory $productCategory) use(&$categoryIds) {
                 $categoryIds[] = $productCategory->getId();
             });
         }

        /* @var Pagerfanta|Product[] $products */
        $products = $productManager->getPage($page, $categoryIds);

        return $this->render('AppBundle:Products:index.html.twig', ['products' => $products, 'categoryId' => $categoryId]);
    }

    public function viewAction(int $id)
    {
        /* @var ProductManager $productManager */
        $productManager = $this->get('app.product_manager');

        /* @var Product $product */
        if(!$product = $productManager->getById($id)) {
            throw $this->createNotFoundException();
        }

        return $this->render('AppBundle:Products:view.html.twig', ['product' => $product]);
    }
}
