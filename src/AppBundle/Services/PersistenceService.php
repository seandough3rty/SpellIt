<?php

/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 2:57 PM
 */

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

/**
 * Class PersistenceService
 * @package AppBundle\Services
 */
class PersistenceService
{
    /** @var EntityManager */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @var object $entity
     * @return object fully managed entity
     */
    public function merge($entity)
    {
        return $this->entityManager->merge($entity);
    }

    /**
     * @param object $entity
     */
    public function persist($entity)
    {
        $this->entityManager->persist($entity);
    }

    /**
     * @param object[] $entities
     */
    public function removeMany(array $entities)
    {
        foreach ($entities as $entity) {
            $this->remove($entity);
        }
    }

    /**
     * @param object $entity
     */
    public function remove($entity)
    {
        $this->entityManager->remove($entity);
    }

    /**
     * Saves the object to the database
     */
    public function flush()
    {
        $this->entityManager->flush();
    }

    /**
     * @param string $entityName
     *   The name of the entity type.
     * @param mixed $id
     *   The entity identifier.
     *
     * @return object
     *   The entity reference
     */
    public function getReference($entityName, $id)
    {
        return $this->entityManager->getReference($entityName, $id);
    }
}
