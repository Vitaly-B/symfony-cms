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
     * @param int $id
     * @param bool $enabled
     *
     * @return QueryBuilder
     */
    public function getQueryBuilderById(int $id, $enabled = true): QueryBuilder
    {
        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->createQueryBuilder('product');
        $queryBuilder->where($queryBuilder->expr()->andX(
            $queryBuilder->expr()->eq('product.id', $id),
            $queryBuilder->expr()->eq('product.enabled', $enabled)
        ));

        return $queryBuilder;
    }

    /**
     * @param array|int[] $productCategoryIds
     * @param bool $enabled
     * @return QueryBuilder
     */
    public function getQueryBuilderByCategories(array $productCategoryIds, bool $enabled = true): QueryBuilder
    {
        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->createQueryBuilder('product');
        $queryBuilder->select('product')
            ->andWhere($queryBuilder->expr()->eq('product.enabled', $enabled))
        ;

        if(!empty($productCategoryIds)) {
            $queryBuilder->join('product.categories', 'categories')
                ->andWhere($queryBuilder->expr()->in('categories.id', $productCategoryIds));
        }

        return $queryBuilder;
    }


}