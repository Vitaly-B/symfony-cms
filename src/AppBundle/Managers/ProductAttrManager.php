<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 19.09.2017
 * Time: 14:10
 */

namespace AppBundle\Managers;

use AppBundle\Entity\Interfaces\ProductAttrInterface;
use AppBundle\Entity\Interfaces\ProductCategoryInterface;
use AppBundle\Repository\ProductAttrRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * ProductAttrManager
 */
class ProductAttrManager extends EntityManager
{
    /* @var ProductCategoryManager */
    private $productCategoryManager;

    /* @var ProductAttrValueManager */
    private $productAttrValueManager;

    /**
     * @param EntityManagerInterface  $entityManager
     * @param string                  $class
     * @param ProductCategoryManager  $productCategoryManager
     * @param ProductCategoryManager  $productCategoryManager
     * @param ProductAttrValueManager $productAttrValueManager
     */
    public function __construct(EntityManagerInterface $entityManager, string $class,
        ProductCategoryManager $productCategoryManager,
        ProductAttrValueManager $productAttrValueManager
    )
    {
        parent::__construct($entityManager, $class);
        $this->productCategoryManager  = $productCategoryManager;
        $this->productAttrValueManager = $productAttrValueManager;

    }

    /**
     * @param ProductCategoryInterface|null $category if null return all
     *
     * @return ProductAttrInterface[]
     */
    public function getAttributes(?ProductCategoryInterface $category): array
    {
        /* @var ProductAttrRepository $repository */
        $repository = $this->getRepository();

        /* @var QueryBuilder $queryBuilder */
        $queryBuilder = $repository->createQueryBuilder('product_attr');

        if ($category) {
            /* @var int[] $ids */
            $ids   = $this->productCategoryManager->getChildrenIds($category, true);
            $ids[] = $category->getId();

            if(!empty($ids)) {
                $queryBuilder->join('product_attr.categories', 'categories')
                    ->where($queryBuilder->expr()->in('categories.id', $ids));
            }
        }

        $queryBuilder->orderBy('product_attr.position', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return ProductAttrInterface
     */
    public function createAttribute(): ProductAttrInterface
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * insert or update
     *
     * @param ProductAttrInterface $productAttr
     * @param bool                 $andFlush
     *
     * @throws OptimisticLockException If a version check on an entity that
     *         makes use of optimistic locking fails.
     * @throws ORMInvalidArgumentException
     */
    public function save(ProductAttrInterface $productAttr, bool $andFlush = true): void
    {
        if($productAttr->getId()) {
            $this->getEntityManager()->merge($productAttr);
        } else {
            $this->getEntityManager()->persist($productAttr);
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