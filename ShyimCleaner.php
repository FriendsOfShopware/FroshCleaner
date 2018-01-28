<?php

namespace ShyimCleaner;

use Shopware\Components\Plugin;
use ShyimCleaner\Components\CompilerPass\ProcessorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ShyimCleaner extends Plugin
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ProcessorCompilerPass());
    }
}