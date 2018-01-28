<?php

namespace ShyimCleaner\Components\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ProcessorCompilerPass
 * @package ShyimCleaner\Components\CompilerPass
 */
class ProcessorCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $services = $container->findTaggedServiceIds('cleanup.processor');
        $collectorDefinition = $container->getDefinition('shyim_cleaner.cleanup_manager');
        foreach ($services as $id => $tags) {
            $collectorDefinition->addMethodCall('addProcessor', [$container->getDefinition($id)]);
        }
    }
}