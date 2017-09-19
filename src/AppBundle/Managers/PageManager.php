<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 18.09.2017
 * Time: 23:01
 */

namespace AppBundle\Managers;

use AppBundle\Entity\Page;
use AppBundle\Managers\Traits\EntityManagerTrait;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Repository\PageRepository;
/**
 * PageManager
 */
class PageManager
{
    use EntityManagerTrait;

    /**
     * @param EntityManagerInterface $entityManager
     * @param string                 $class
     */
    public function __construct(EntityManagerInterface $entityManager, string $class)
    {
        $this->entityManager = $entityManager;
        $this->class         = $class;
    }

    /**
     * @param int $id
     * @param bool $enabled
     *
     * @return Page|null
     */
    public function getById(int $id, bool $enabled = true): ?Page
    {
        /* @var PageRepository $repository */
        $repository = $this->getRepository();

        /* @var  QueryBuilder $queryBuilder*/
        $queryBuilder = $repository->createQueryBuilder('page');
        $queryBuilder->select('page')->where(
            $queryBuilder->expr()->andX(
                $queryBuilder->expr()->eq('page.id', $id),
                $queryBuilder->expr()->eq('page.enabled', $enabled)
            )
        );

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}