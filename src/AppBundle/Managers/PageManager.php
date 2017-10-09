<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 18.09.2017
 * Time: 23:01
 */

namespace AppBundle\Managers;

use AppBundle\Entity\Page;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Repository\PageRepository;

/**
 * PageManager
 */
final class PageManager extends EntityManager
{
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

    /**
     * @param bool $enabled
     * @return array|Page[]
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
     * @param Page $page
     * @param bool $andFlush
     */
    public function updatePage(Page $page, $andFlush = true): void
    {
        if($page->getId()) {
            $this->getEntityManager()->merge($page);
        } else {
            $this->getEntityManager()->persist($page);
        }

        if($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
}