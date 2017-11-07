<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 19.09.2017
 * Time: 18:46
 */

namespace App\AppBundle\Managers;

use App\AppBundle\Entity\Interfaces\ProductAttrValueInterface;
use App\AppBundle\Entity\Interfaces\ProductCategoryInterface;
use App\AppBundle\Repository\ProductAttrValueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * ProductAttrValueManager
 */
class ProductAttrValueManager extends EntityManager
{
    /* @var ProductCategoryManager */
    private $productCategoryManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param string                 $class
     * @param ProductCategoryManager $productCategoryManager
     */
    public function __construct(EntityManagerInterface $entityManager, string $class, ProductCategoryManager $productCategoryManager)
    {
        parent::__construct($entityManager, $class);
        $this->productCategoryManager = $productCategoryManager;
    }

    /**
     * @param ProductCategoryInterface|null $category if null return all
     *
     * @return ProductAttrValueInterface[]
     */
    public function getUniqueValuesByCategory(?ProductCategoryInterface $category): array
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

    /**
     * insert or update
     *
     * @param ProductAttrValueInterface $productAttrValue
     * @param bool                 $andFlush
     *
     * @throws OptimisticLockException If a version check on an entity that
     *         makes use of optimistic locking fails.
     * @throws ORMInvalidArgumentException
     */
    public function save(ProductAttrValueInterface $productAttrValue, bool $andFlush = true): void
    {
        if($productAttrValue->getId()) {
            $this->getEntityManager()->merge($productAttrValue);
        } else {
            $this->getEntityManager()->persist($productAttrValue);
        }

        if($andFlush) {
            $this->flush();
        }
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}