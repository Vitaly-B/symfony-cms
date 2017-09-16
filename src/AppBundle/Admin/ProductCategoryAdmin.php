<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 07.09.2017
 * Time: 14:31
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Interfaces\ProductCategoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use RedCode\TreeBundle\Admin\AbstractTreeAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Model\ModelManager;


class ProductCategoryAdmin extends AbstractTreeAdmin
{
    protected $translationDomain = 'AppAdmin';

    protected function configureFormFields(FormMapper $form)
    {
        /* @var EntityManagerInterface $em */
        $em = $this->getModelManager()->getEntityManager($this->getClass());

        /* @var ProductCategoryInterface $productCategory */
        $productCategory = $this->getSubject();

        /* @var \Doctrine\ORM\QueryBuilder $qb */
        $qb = $em->getRepository($this->getClass())
            ->getNodesHierarchyQueryBuilder()
            ->andWhere('node.id != :id')
            ->setParameter(
                'id',
                $productCategory->getId() ?: 0,
                \Doctrine\DBAL\Types\Type::INTEGER
            );


        $form->add('title', null, ['label' => 'Title'])
            ->add('parent','sonata_type_model', [
                    'label'    => 'Parent category',
                    'required' => false,
                    'property' => 'titleLeveling',
                    'query'    => $qb->getQuery(),
                ]);
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('id',null, ['sortable' => false, 'header_style' => 'width: 65px;'])
            ->add('title',null,[
                    'header_style' => 'width: 70%;',
                    'sortable'     => false,
                    'label'        => 'Title',
                    'editable'     => true,
                    'template'     => 'AppBundle:Admin:AdminTemplates/list_fields/_leveling_field.html.twig'
            ])
            ->add('_action',null, [
                    'actions' => [
                        'edit'   => [],
                        'delete' => [],
                    ]
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('id', null)
            ->add('title', null, ['label' => 'Title']);
    }

    public function createQuery($context = 'list')
    {
        //TODO this method corrected sorting problem
        /* @var \Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery $proxyQuery */
        $proxyQuery = parent::createQuery($context);

        /* @var \Doctrine\ORM\QueryBuilder $queryBuilder */
        $queryBuilder = $proxyQuery->getQueryBuilder();
        $queryBuilder->orderBy('o.root,o.lft', 'ASC');

        return new \AppBundle\Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQueryTree(
            $queryBuilder
        );
    }
}