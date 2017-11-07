<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 13:53
 */

namespace App\AppBundle\Controller\Admin;

use App\AppBundle\Controller\Admin\Traits\SortableControllerTrait;
use Sonata\AdminBundle\Controller\CRUDController;

/**
 * ProductAttrCRUDController
 */
class ProductAttrCRUDController extends CRUDController
{
    use SortableControllerTrait;
}