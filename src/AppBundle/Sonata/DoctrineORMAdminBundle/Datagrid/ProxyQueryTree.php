<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 08.09.2017
 * Time: 1:26
 */

namespace AppBundle\Sonata\DoctrineORMAdminBundle\Datagrid;


use Doctrine\ORM\QueryBuilder;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

class ProxyQueryTree extends ProxyQuery
{

    public function __construct(QueryBuilder $queryBuilder)
    {
        parent::__construct($queryBuilder);
    }

    protected function getFixedQueryBuilder(QueryBuilder $queryBuilder)
    {
        $orderByDQLPart = $queryBuilder->getDQLPart('orderBy');
        $queryBuilder->resetDQLPart('orderBy');
        $queryBuilder = parent::getFixedQueryBuilder($queryBuilder);
        $queryBuilder->add('orderBy',$orderByDQLPart, true);

        return $queryBuilder;
    }

}