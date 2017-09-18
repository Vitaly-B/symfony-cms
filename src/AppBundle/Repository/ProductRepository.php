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
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder->where($queryBuilder->expr()->andX(
            $queryBuilder->expr()->eq('p.id', $id),
            $queryBuilder->expr()->eq('p.enabled', $enabled)
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
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder->select('p')
            ->andWhere($queryBuilder->expr()->eq('p.enabled', $enabled))
        ;

        if(!empty($productCategoryIds)) {
            $queryBuilder->join('p.categories', 'categories')
                ->andWhere($queryBuilder->expr()->in('categories.id', $productCategoryIds));
        }

        return $queryBuilder;
    }


}