<?php
/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 3:06 PM
 */

namespace AppBundle\Controller;


use AppBundle\Services\HeaderService;
use AppBundle\Services\RuleService;
use AppBundle\Services\SetService;
use function Monolog\Handler\error_log;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SetController extends AbstractController
{

    /**
     * @var HeaderService
     */
    private $headerService;

    /**
     * @var RuleService
     */
    private $ruleService;

    /**
     * SetController constructor.
     * @param HeaderService $headerService
     * @param RuleService $ruleService
     */
    public function __construct(HeaderService $headerService,
                                RuleService $ruleService)
    {
        $this->headerService = $headerService;
        $this->ruleService = $ruleService;
    }

    public function createNewSet(Request $request)
    {
        $body = $request->getContent();

        /*
         * Expected Data Input:
         * {"languageName":"English"}
         */

        try {
            $this->setService->createNewSet(json_decode($body, true));
        } catch (\Exception $e) {
            \error_log($e->getMessage());
            return $this->badRequestResponse($e);
        }

        $statusCode = 201;

        $response = new JsonResponse(['status' => $statusCode, 'type' => 'about:blank',], $statusCode);

        $response->headers->set('Content-Type', 'application/json');

        $messageUrl = $this->generateUrl(
            'create_new_set'
        );

        $response->headers->set('Location', $messageUrl);
        return $response;
    }

    public function addNewHeader(Request $request)
    {
        $body = $request->getContent();

        /*
         * Expected Data Input:
         * {"setID":13,
         *  "optionName":"SFX",
         *  "className":"S",
         *  "crossProduct":true
         * }
         */

        try {
            $this->headerService->addNewHeader(json_decode($body, true));
        } catch (\Exception $e) {
            \error_log($e->getMessage());
            return $this->badRequestResponse($e);
        }

        $statusCode = 201;

        $response = new JsonResponse(['status' => $statusCode, 'type' => 'about:blank',], $statusCode);

        $response->headers->set('Content-Type', 'application/json');

        $messageUrl = $this->generateUrl(
            'add_new_header'
        );

        $response->headers->set('Location', $messageUrl);
        return $response;
    }

    public function addNewRule(Request $request)
    {
        $body = $request->getContent();

        /*
         * Expected Data Input:
         * {"headerID":12,
         *  "strippingChars":"y",
         *  "affix":"ies",
         *  "conditional":"y"
         * }
         */

        try {
            $this->ruleService->addNewRule(json_decode($body, true));
        } catch (\Exception $e) {
            \error_log($e->getMessage());
            return $this->badRequestResponse($e);
        }

        $statusCode = 201;

        $response = new JsonResponse(['status' => $statusCode, 'type' => 'about:blank',], $statusCode);

        $response->headers->set('Content-Type', 'application/json');

        $messageUrl = $this->generateUrl(
            'add_new_rule'
        );

        $response->headers->set('Location', $messageUrl);
        return $response;
    }

    public function deleteRule(Request $request)
    {
        $body = $request->getContent();

        /*
         * Expected Data Input:
         * {"ruleID":11}
         */

        try {
            $this->ruleService->deleteRule(json_decode($body, true));
        } catch (\Exception $e) {
            \error_log($e->getMessage());
            return $this->badRequestResponse($e);
        }

        $statusCode = 201;

        $response = new JsonResponse(['status' => $statusCode, 'type' => 'about:blank',], $statusCode);

        $response->headers->set('Content-Type', 'application/json');

        $messageUrl = $this->generateUrl(
            'delete_rule'
        );

        $response->headers->set('Location', $messageUrl);
        return $response;
    }

    /**
     * @param \Exception $e
     * @return JsonResponse
     */
    private function badRequestResponse(\Exception $e)
    {
        $statusCode = 500;
        $message = $e->getMessage();

        \error_log($message);

        $response = new JsonResponse([
            'status' => $statusCode,
            'type' => 'about:blank',
            'detail' => $message
        ], $statusCode);

        $response->headers->set('Content-Type', 'application/problem+json');
        return $response;
    }
}