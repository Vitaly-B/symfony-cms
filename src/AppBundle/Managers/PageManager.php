<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 18.09.2017
 * Time: 23:01
 */

namespace AppBundle\Managers;

use AppBundle\Entity\Interfaces\PageInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Repository\PageRepository;

/**
 * PageManager
 */
class PageManager extends EntityManager
{
    /**
     * @param int  $id
     * @param bool $enabled
     *
     * @return PageInterface|null
     */
    public function getById(int $id, bool $enabled = true): ?PageInterface
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

    /**
     * @param bool $enabled
     *
     * @return array|PageInterface[]
     */
    public function getPages($enabled = true): array
    {
        /* @var PageRepository $repository */
        $repository = $this->getRepository();

        /* @var  QueryBuilder $queryBuilder*/
        $queryBuilder = $repository->createQueryBuilder('page');
        $queryBuilder->select('page')->where(
                $queryBuilder->expr()->eq('page.enabled', $enabled)
        );

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return PageInterface
     */
    public function createPage(): PageInterface
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * insert or update
     *
     * @param PageInterface $page
     * @param bool          $andFlush
     *
     * @throws OptimisticLockException If a version check on an entity that
     *         makes use of optimistic locking fails.
     * @throws ORMInvalidArgumentException
     */
    public function save(PageInterface $page, bool $andFlush = true): void
    {
        if($page->getId()) {
            $this->getEntityManager()->merge($page);
        } else {
            $this->getEntityManager()->persist($page);
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