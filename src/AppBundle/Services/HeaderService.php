<?php
/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 3:00 PM
 */

namespace AppBundle\Services;

use AppBundle\Model\Repository\HeaderRepository;
use AppBundle\Model\Repository\RuleRepository;
use AppBundle\Model\Repository\SetRepository;
use AppBundle\Model\Entity\Header;

class HeaderService
{

    /**
     * @var HeaderRepository
     */
    private $headerRepository;

    /**
     * @var SetRepository
     */
    private $setRepository;

    /**
     * @var RuleRepository
     */
    private $ruleRepository;
    /**
     * @var PersistenceService
     */
    private $persistenceService;

    /**
     * HeaderService constructor.
     * @param HeaderRepository $headerRepository
     * @param SetRepository $setRepository
     * @param RuleRepository $ruleRepository
     * @param PersistenceService $persistenceService
     */
    public function __construct(HeaderRepository $headerRepository,
                                SetRepository $setRepository,
                                RuleRepository $ruleRepository,
                                PersistenceService $persistenceService)
    {
        $this->headerRepository = $headerRepository;
        $this->setRepository = $setRepository;
        $this->ruleRepository = $ruleRepository;
        $this->persistenceService = $persistenceService;
    }

    public function addNewHeader($data)
    {
        $header = new Header();

        $set = $this->setRepository->findOneBy(['setID'=>$data['setID']]);

        $header
            ->setSet($set)
            ->setOptionName($data['optionName'])
            ->setClassName($data['className'])
            ->setCrossProduct($data['crossProduct'])
            ->setLineCount(0);

        $this->persistenceService->persist($header);
        $this->persistenceService->flush();
    }

}