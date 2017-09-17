<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 11.09.2017
 * Time: 18:41
 */

namespace AppBundle\Repository;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * ProductRepository
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param array|int[] $productCategoryIds
     * @return QueryBuilder
     */
    public function getQueryBuilderByCategories(array $productCategoryIds): QueryBuilder
    {
        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder->select('p');

        if(!empty($productCategoryIds)) {
            $queryBuilder->join('p.categories', 'categories')
                ->andWhere(
                    $queryBuilder->expr()->in('categories.id', $productCategoryIds)
                );
        }

        return $queryBuilder;
    }

    /**
     * @param array|int[] $productCategoryIds
     * @return Query
     */
    public function getQueryByCategories(array $productCategoryIds): Query
    {
        return $this->getQueryBuilderByCategories($productCategoryIds)->getQuery();
    }

}