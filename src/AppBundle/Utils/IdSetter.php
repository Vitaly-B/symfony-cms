<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 27.10.2017
 * Time: 19:59
 */

namespace AppBundle\Utils;

use AppBundle\Entity\Interfaces\IdentifierInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * IdSetter
 */
class IdSetter
{
    /**
     * @param int                    $id
     * @param IdentifierInterface    $entity
     * @param EntityManagerInterface $entityManager
     *
     * @return void
     */
    public function setId(int $id, IdentifierInterface $entity, EntityManagerInterface $entityManager): void
    {
        $idRef = new \ReflectionProperty(get_class($entity), "id");
        $idRef->setAccessible(true);
        $idRef->setValue($entity, $id);

        /* @var ClassMetadata */
        $metadata = $entityManager->getClassMetadata(get_class($entity));

        $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        $unitOfWork = $entityManager->getUnitOfWork();
        $persistersRef = new \ReflectionProperty($unitOfWork, "persisters");
        $persistersRef->setAccessible(true);
        $persisters = $persistersRef->getValue($unitOfWork);
        unset($persisters[get_class($entity)]);
        $persistersRef->setValue($unitOfWork, $persisters);
    }
}