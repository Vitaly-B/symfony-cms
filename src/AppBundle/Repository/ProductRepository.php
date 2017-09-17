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
    public function getQueryByCategories(array $productCategoryIds): Query
    {
    }

    public function getQueryBuilderByCategories(array $productCategoryIds): QueryBuilder
    {
    }

    public function getFindByCategories(array $productCategoryIds): array
    {
    }

}