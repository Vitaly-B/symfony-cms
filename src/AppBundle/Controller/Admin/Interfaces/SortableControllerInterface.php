<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 13:46
 */

namespace AppBundle\Controller\Admin\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


interface SortableControllerInterface
{
    /**
     * @param int $position
     * @param Request $request
     *
     * @return Response
     * implements default AppBundle\Controller\Admin\Traits\SortableControllerTrait
     */
    public function moveAction(int $position, Request $request): Response;
}