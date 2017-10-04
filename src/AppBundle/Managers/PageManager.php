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
}