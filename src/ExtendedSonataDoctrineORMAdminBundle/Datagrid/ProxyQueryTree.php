<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 08.09.2017
 * Time: 1:26
 */

namespace App\ExtendedSonataDoctrineORMAdminBundle\Datagrid;

use Doctrine\ORM\QueryBuilder;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

/**
 * ProxyQueryTree
 */
class ProxyQueryTree extends ProxyQuery
{

    /**
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        parent::__construct($queryBuilder);
    }

    /**
     * @param QueryBuilder $queryBuilder
     *
     * @return QueryBuilder
     */
    protected function getFixedQueryBuilder(QueryBuilder $queryBuilder)
    {
        $orderByDQLPart = $queryBuilder->getDQLPart('orderBy');
        $queryBuilder->resetDQLPart('orderBy');
        $queryBuilder = parent::getFixedQueryBuilder($queryBuilder);
        $queryBuilder->add('orderBy',$orderByDQLPart, true);

        return $queryBuilder;
    }

}