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
use AppBundle\Repository\ProductAttrRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * ProductAttrManager
 */
final class ProductAttrManager extends EntityManager
{
    /* @var ProductCategoryManager */
    private $productCategoryManager;

    /* @var ProductAttrValueManager */
    private $productAttrValueManager;

    /**
     * @param ContainerInterface      $container
     * @param string                  $class
     * @param ProductCategoryManager  $productCategoryManager
     * @param ProductCategoryManager  $productCategoryManager
     * @param ProductAttrValueManager $productAttrValueManager
     */
    public function __construct(ContainerInterface $container, string $class,
        ProductCategoryManager $productCategoryManager,
        ProductAttrValueManager $productAttrValueManager
    )
    {
        parent::__construct($container, $class);
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