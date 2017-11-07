<?php

namespace App\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ProductAttrController
 */
class ProductAttrController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function filterFormAction(Request $request): Response
    {
        /* @var FormInterface $filterForm */
        $filterForm = $filterManager = $this->get('app.managers.product_manager')->getFilterForm();

        return $this->render('AppBundle:ProductAttr:_filter_form.html.twig', ['filterForm' => $filterForm->createView()]);
    }
}
