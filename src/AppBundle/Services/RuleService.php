<?php
/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 3:02 PM
 */

namespace AppBundle\Services;


use AppBundle\Model\Repository\HeaderRepository;
use AppBundle\Model\Repository\RuleRepository;
use AppBundle\Model\Entity\Rule;

class RuleService
{
    /**
     * @var RuleRepository
     */
    private $ruleRepository;

    /**
     * @var HeaderRepository
     */
    private $headerRepository;

    /**
     * @var PersistenceService
     */
    private $persistenceService;

    /**
     * RuleService constructor.
     * @param RuleRepository $ruleRepository
     * @param HeaderRepository $headerRepository
     * @param PersistenceService $persistenceService
     */
    public function __construct(RuleRepository $ruleRepository,
                                HeaderRepository $headerRepository,
                                PersistenceService $persistenceService)
    {
        $this->ruleRepository = $ruleRepository;
        $this->headerRepository = $headerRepository;
        $this->persistenceService = $persistenceService;
    }

    public function addNewRule($data)
    {
        $rule = new Rule();

        $header = $this->headerRepository->findOneBy(['headerID'=>$data['headerID']]);
        $lineCount = $header->getLineCount();
        $header->setLineCount($lineCount+1);

        $rule
            ->setHeader($header)
            ->setStrippingChars($data['strippingChars'])
            ->setAffix($data['affix'])
            ->setConditional($data['conditional']);

        $this->persistenceService->persist($header);
        $this->persistenceService->persist($rule);
        $this->persistenceService->flush();
    }

    public function deleteRule($data)
    {
        $rule = $this->ruleRepository->findOneBy(['ruleID'=>$data['ruleID']]);

        $this->persistenceService->remove($rule);
        $this->persistenceService->flush();
    }
}