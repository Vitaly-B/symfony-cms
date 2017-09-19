<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 19.09.2017
 * Time: 18:46
 */

namespace AppBundle\Managers;

use AppBundle\Entity\ProductAttrValue;
use AppBundle\Entity\ProductCategory;
use AppBundle\Managers\Traits\EntityManagerTrait;
use AppBundle\Repository\ProductAttrValueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * ProductAttrValueManager
 */
class ProductAttrValueManager
{
    use EntityManagerTrait;

    /* @var ProductCategoryManager */
    private $productCategoryManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param string $class
     * @param ProductCategoryManager $productCategoryManager
     */
    public function __construct(EntityManagerInterface $entityManager, string $class, ProductCategoryManager $productCategoryManager)
    {
        $this->entityManager          = $entityManager;
        $this->class                  = $class;
        $this->productCategoryManager = $productCategoryManager;
    }

    /**
     * @param ProductCategory|null $category if null return all
     *
     * @return ProductAttrValue[]
     */
    public function getUniqueValuesByCategory(?ProductCategory $category): array
    {
        /* @var ProductAttrValueRepository $repository */
        $repository = $this->getRepository();

        /* @var int[] $ids */
        $ids = $this->productCategoryManager->getChildrenIds($category);

        //Add current category id
        if($category) {
            $ids[] = $category->getId();
        }

        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->getRepository()->createQueryBuilder('attr_value');
        $queryBuilder->join('attr_value.attribute', 'attribute');

        if(!empty($ids)) {
            $queryBuilder->join('attribute.categories', 'attribute_categories')
                ->where($queryBuilder->expr()->in('attribute_categories.id', $ids));
        }

        $queryBuilder->groupBy('attr_value.value')
            ->orderBy('attr_value.value', 'ASC')
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}