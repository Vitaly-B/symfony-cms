<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 13:53
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Interfaces\SortableControllerInterface;
use AppBundle\Controller\Admin\Traits\SortableControllerTrait;
use Sonata\AdminBundle\Controller\CRUDController;

/**
 * ProductAttrCRUDController
 */
class ProductAttrCRUDController extends CRUDController implements SortableControllerInterface
{
    use SortableControllerTrait;
}