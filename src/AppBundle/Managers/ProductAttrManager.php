<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 19.09.2017
 * Time: 14:10
 */

namespace AppBundle\Managers;

use AppBundle\Entity\ProductAttr;
use AppBundle\Entity\ProductCategory;
use AppBundle\Managers\Traits\EntityManagerTrait;
use AppBundle\Repository\ProductAttrRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * ProductAttrManager
 */
class ProductAttrManager
{
    use EntityManagerTrait;

    /* @var ProductCategoryManager */
    private $productCategoryManager;

    /* @var ProductAttrValueManager */
    private $productAttrValueManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ProductCategoryManager $productCategoryManager
     * @param string $class
     * @param ProductCategoryManager $productCategoryManager
     * @param ProductAttrValueManager $productAttrValueManager
     */
    public function __construct(EntityManagerInterface $entityManager,
        string $class,
        ProductCategoryManager $productCategoryManager,
        ProductAttrValueManager $productAttrValueManager)
    {
        $this->entityManager           = $entityManager;
        $this->class                   = $class;
        $this->productCategoryManager  = $productCategoryManager;
        $this->productAttrValueManager = $productAttrValueManager;

    }

    /**
     * @param ProductCategory|null $category if null return all
     *
     * @return ProductAttr[]
     */
    public function getAttributes(?ProductCategory $category): array
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


}