<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\FilterAttr;
use AppBundle\Form\Filter\FilterType;
use AppBundle\Managers\FilterManager;
use AppBundle\Model\Filter\Filter;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ProductAttrController
 */
class ProductAttrController extends Controller
{
    /**
     * @return Response
     */
    public function filterFormAction(): Response
    {
        /* @var FormInterface $filterForm */
        $filterForm = $filterManager = $this->get('app.managers.filter_manager')->getFilterForm();

        return $this->render('AppBundle:ProductAttr:_filter_form.html.twig', ['filterForm' => $filterForm->createView()]);
    }
}
