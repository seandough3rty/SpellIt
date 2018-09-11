<?php
namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\Resource\DirectoryResource;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;

/**
 * Created by PhpStorm.
 * User: SLU
 * Date: 9/8/2018
 * Time: 2:37 PM
 */

/**
 * Class ValidationLoader
 * @package AppBundle\DependencyInjection
 */
class ValidationLoader implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $root = realpath($container->getParameter('kernel.root_dir'));
        $validatorBuilder = $container->getDefinition('validator.builder');
        $validatorFiles = array();
        $finder = new Finder();
        foreach ($finder->files()->in($root . '/config/validation') as $file) {
            $validatorFiles[] = $file->getRealPath();
        }
        $validatorBuilder->addMethodCall('addYamlMappings', array($validatorFiles));
        // add resources to the container to refresh cache after updating a file
        $container->addResource(new DirectoryResource($root . '/config/validation'));
    }
}
