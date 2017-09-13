<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 29.08.2017
 * Time: 21:23
 */

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\User;
use Sonata\AdminBundle\Exception\ModelManagerException;


class UserCRUDController extends CRUDController
{

    /**
     * Delete user image action.
     *
     * @param int|string|null $id
     *
     * @return Response|RedirectResponse
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function removeImageAction($id)
    {
        $request = $this->getRequest();
        $id      = $request->get($this->admin->getIdParameter());
        /** @var User $user */
        $user = $this->admin->getObject($id);


        if ( ! $user) {
            throw new NotFoundHttpException(
                sprintf('unable to find the object with id : %s', $id)
            );
        }

        if ($this->getRestMethod() == 'DELETE') {

            // check the csrf token
            $this->validateCsrfToken('sonata.delete');

            $objectName = $this->admin->toString($user);


            try {

                $user->removePreview();
                $this->admin->update($user);


                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(
                        ['result' => 'ok'],
                        200,
                        []
                    );
                }

                $this->addFlash(
                    'sonata_flash_success',
                    $this->trans('message.delete_image_flash_success')
                );

            } catch (ModelManagerException $e) {

                $this->handleModelManagerException($e);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(
                        ['result' => 'error'],
                        200,
                        []
                    );
                }

                $this->addFlash(
                    'sonata_flash_error',
                    $this->trans('message.delete_image_flash_error')
                );
            }

            return new RedirectResponse(
                $this->admin->generateObjectUrl('edit', $user)
            );
        }

        return $this->render(
            'AppBundle:Admin/User:remove.image.html.twig',
            [
                'object' => $user,
                'action' => 'delete',
                'csrf_token' => $this->getCsrfToken('sonata.delete'),
            ]
        );
    }

}