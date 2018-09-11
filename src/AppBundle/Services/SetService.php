<?php
/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 2:59 PM
 */

namespace AppBundle\Services;


use AppBundle\Model\Repository\SetRepository;
use AppBundle\Model\Entity\Set;

class SetService
{
    /**
     * @var SetRepository
     */
    private $setRepository;

    /**
     * @var PersistenceService
     */
    private $persistenceService;

    /**
     * SetService constructor.
     * @param SetRepository $setRepository
     * @param PersistenceService $persistenceService
     */
    public function __construct(SetRepository $setRepository, PersistenceService $persistenceService)
    {
        $this->setRepository = $setRepository;
        $this->persistenceService = $persistenceService;
    }

    public function createNewSet($data)
    {
        $set = new Set();
        $set->setLanguageName($data['languageName']);

        $this->persistenceService->persist($set);
        $this->persistenceService->flush();
    }

    public function getAllSets()
    {
        return $this->setRepository->findAll();
    }
}