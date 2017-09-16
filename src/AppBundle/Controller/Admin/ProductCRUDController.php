<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 16.09.2017
 * Time: 23:11
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Interfaces\ProductInterface;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

class ProductCRUDController extends CRUDController
{
    public function moveAction(int $position, Request $request)
    {
        if($this->admin->getSubject() instanceof ProductInterface) {

            $this->admin->getSubject()->setPosition($position);

            try {

                $this->admin->update($this->admin->getSubject());

            } catch (ModelManagerException $e) {
                $this->handleModelManagerException($e);
            }
        }

        // redirect to back
        return $this->redirect( $request->headers->get('referer'));
    }
}