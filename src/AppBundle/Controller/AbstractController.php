<?php
/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 2:45 PM
 */
namespace AppBundle\Controller;

use AppBundle\Model\Entity\Set;
use AppBundle\Services\SetService;
use JMS\Serializer\Serializer;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class AbstractController
 * @package AppBundle\Controller
 */
abstract class AbstractController
{
    /**
     * @var RouterInterface|null
     */
    protected $router;

    /**
     * @var EngineInterface|null
     */
    protected $templating;

    /**
     * @var FormFactory|null
     */
    protected $formFactory;

    /**
     * @var RequestStack|null
     */
    protected $request;

    /**
     * @var Serializer|null
     */
    protected $serializer;

    /**
     * @var TokenStorageInterface|null
     */
    protected $tokenStorage;

    /**
     * @var SetService
     */
    protected $setService;

    /**
     * @var Set[]
     */
    protected $sets;

    /**
     * @param RouterInterface $router
     */
    final public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param EngineInterface $templating
     */
    final public function setTemplating(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param FormFactory $formFactory
     */
    final public function setFormFactory(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param RequestStack $requestStack
     */
    final public function setRequest(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param Serializer $serializer
     */
    final public function setSerializer(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    final public function setTokenStorage(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param SetService $setService
     */
    final public function setSetService(SetService $setService)
    {
        $this->setService = $setService;
    }

    /**
     * @param string $url
     * @param int $status
     * @return RedirectResponse
     */
    final public function redirect($url, $status = 302)
    {
        return new RedirectResponse($url, $status);
    }

    /**
     * @param string $route
     * @param array $parameters
     * @param int $status
     * @return RedirectResponse
     */
    final public function redirectToRoute($route, array $parameters = array(), $status = 302)
    {
        if (is_null($this->router)) {
            throw new InvalidConfigurationException(
                '"@router" was not injected into the controller "' . get_class($this) . '"'
            );
        }

        return $this->redirect(
            $this->router->generate($route, $parameters),
            $status
        );
    }

    /**
     * @param string $template
     * @param array $paramters
     * @param Response|null $response
     * @return Response
     */
    final public function renderResponse($template, array $paramters = array(), Response $response = null)
    {
        if (is_null($this->templating)) {
            throw new InvalidConfigurationException(
                '"@templating" was not injected into the controller "' . get_class($this) . '"'
            );
        }

        if (is_null($response)) {
            $response = new Response();
        }

        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');

        $response->setContent(
            $this->templating->render($template, $paramters)
        );

        return $response;
    }

    /**
     * @param string $message
     * @param \Exception|null $previous
     * @return AccessDeniedException
     */
    final protected function createAccessDeniedException($message = 'Access denied.', \Exception $previous = null)
    {
        return new AccessDeniedException($message, $previous);
    }

    final public function getAllSets()
    {
        $this->sets = $this->setService->getAllSets();
        return $this->sets;
    }

    /**
     * @param $route
     * @param array $parameters
     * @param int $referenceType
     * @return mixed
     */
    final public function generateUrl(
        $route,
        $parameters = array(),
        $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH
    ) {
        return $this->router->generate($route, $parameters, $referenceType);
    }
}
