<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\FilterAttr;
use AppBundle\Form\Filter\FilterType;
use AppBundle\Managers\FilterManager;
use AppBundle\Model\Filter\Filter;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ProductAttrController
 */
class ProductAttrController extends Controller
{
    /**
     * @param Request $request
     * @param int|null $categoryId
     *
     * @return Response
     */
    public function filterFormAction(Request $request, ?int $categoryId = null): Response
    {
        /* @var  FilterManager */
        $filterManager = $this->get('app.managers.filter_manager');

        if($categoryId) {
            $productCategoryManager = $this->get('app.managers.product_category_manager');
            $filterManager->setProductCategory($productCategoryManager->getById($categoryId));
        }

        /* @var  Filter */
        $filter = $filterManager->filterFactory();

        /* @var Form $filterForm */
        $filterForm = $this->createForm(FilterType::class, $filter);
        $filterForm->handleRequest($request);

        return $this->render('AppBundle:ProductAttr:_filter_form.html.twig', ['filterForm' => $filterForm->createView()]);
    }
}
