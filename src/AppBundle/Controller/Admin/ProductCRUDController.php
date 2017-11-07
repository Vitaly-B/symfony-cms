<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 23:11
 */

namespace App\AppBundle\Controller\Admin;

use App\AppBundle\Controller\Admin\Traits\SortableControllerTrait;
use Sonata\AdminBundle\Controller\CRUDController;

/**
 * ProductCRUDController
 */
class ProductCRUDController extends CRUDController
{
    use SortableControllerTrait;
}