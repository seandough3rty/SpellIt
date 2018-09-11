<?php
namespace AppBundle\Model\Repository;

use Doctrine\ORM\EntityRepository;
use Psr\Log\LoggerInterface;

/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 2:32 PM
 */


/**
 * Class AbstractDoctrineRepository
 * @package AppBundle\Model\Repository
 */
abstract class AbstractDoctrineRepository
{
    /**
     * @var EntityRepository
     */
    protected $entityRepository;

    /**
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    /**
     * @param LoggerInterface $logger
     */
    final public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Retrieves an entity by its primary key
     *
     * @param mixed $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->entityRepository->find($id);
    }

    /**
     * @param array $params
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return null|\object[] entity
     */
    public function findBy(array $params, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->entityRepository->findBy($params, $orderBy, $limit, $offset);
    }

    /**
     * @param array $params
     *   Associative array of field name to expected value
     * @return mixed
     */
    public function findOneBy(array $params)
    {
        return $this->entityRepository->findOneBy($params);
    }

    /**
     * Return all records
     * @return array
     */
    public function findAll()
    {
        return $this->entityRepository->findAll();
    }
}
