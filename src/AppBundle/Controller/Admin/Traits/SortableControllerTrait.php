<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 17.09.2017
 * Time: 13:49
 */

namespace AppBundle\Controller\Admin\Traits;

use AppBundle\Entity\Interfaces\SortableInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Exception\ModelManagerException;
/**
 * SortableControllerTrait
 */
trait SortableControllerTrait
{
    /**
     * @param int     $position
     * @param Request $request
     *
     * @return Response
     *
     * @throws ModelManagerException
     * @throws \LogicException
     */
    public function moveAction(int $position, Request $request): Response
    {
        if (!$this->admin->getSubject() instanceof SortableInterface) {
            throw new \LogicException(
            get_class($this->admin->getSubject()) . ' not implemented '.
            SortableInterface::class);
        }

        $this->admin->getSubject()->setPosition($position);

        try {

            $this->admin->update($this->admin->getSubject());

        } catch (ModelManagerException $e) {
            $this->handleModelManagerException($e);
        }

        // redirect to back
        return $this->redirect($request->headers->get('referer'));
    }
}