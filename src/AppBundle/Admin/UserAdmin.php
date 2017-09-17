<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 27.08.2017
 * Time: 18:06
 */

namespace AppBundle\Admin;

use FOS\UserBundle\Model\UserInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * UserAdmin
 */
class UserAdmin extends AbstractAdmin
{

    protected $translationDomain = 'AppAdmin';

    protected function configureFormFields(FormMapper $form)
    {
        /* @var UserInterface $user */
        $user = $this->getSubject();

        $form->with('General')
            ->add('username', null, ['label' => 'Username'])
            ->add('email', null, ['label' => 'Email'])
            ->add('plainPassword','repeated',[
                        'type'               => 'password',
                        'translation_domain' => $this->translationDomain,
                        'first_options'      => array('label' => 'Password'),
                        'second_options'     => array('label' => 'Ppassword repeat'),
                        'required'           => false
                ])
            ->add('enabled', null, ['label' => 'Enabled'])
            ->add('image','sonata_media_type', [
                    'label'    => 'Image',
                    'context'  => 'user',
                    'provider' => 'sonata.media.provider.image'
            ]);


        $form->end();
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('id')
            ->add('username',null, ['label' => 'Username', 'editable' => true])
            ->add('email',null, ['label' => 'Email', 'editable' => true])
            ->add('created_at', 'datetime', ['label' => 'Created at'])
            ->add('updated_at', 'datetime', ['label' => 'Updated at'])
            ->add('lastLogin','datetime', ['label' => 'Last login', 'editable' => true])
            ->add('enabled',null,['label' => 'Enabled', 'editable' => true])
            ->add('_action',null,[
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('id')
            ->add('username', null, ['label' => 'Username'])
            ->add('email', null, ['label' => 'Email'])
            ->add('enabled', null, ['label' => 'Enabled']);
    }

    protected function configureShowFields(ShowMapper $show)
    {
        $show->add('id')
            ->add('username', null, ['label' => 'Username'])
            ->add('email', null, ['label' => 'Email'])
            ->add('created_at', 'datetime', ['label' => 'Created at'])
            ->add('updated_at', 'datetime', ['label' => 'Updated at'])
            ->add('last_login', 'datetime', ['label' => 'Last login'])
            ->add('enabled', null, ['label' => 'Enabled'])
            ->add('image', null, ['label' => 'Image'])
            ->add('roles', null, ['label' => 'Roles']);
    }

    /**
     * @param UserInterface $user
     *
     * @throws \Sonata\AdminBundle\Exception\ModelManagerException
     */
    public function preValidate($user)
    {
        if ($user instanceof UserInterface) {
            /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
            $userManager = $this->getConfigurationPool()->getContainer()->get(
                'fos_user.user_manager'
            );
            $userManager->updatePassword($user);
            $userManager->updateCanonicalFields($user);
        } else {
            throw new \Sonata\AdminBundle\Exception\ModelManagerException(
                sprintf(
                    '%s not implement \FOS\UserBundle\Model\UserInterface',
                    is_object($user) ? get_class($user) : gettype($user)
                )
            );
        }
    }
}