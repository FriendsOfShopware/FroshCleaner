<?php

namespace ShyimCleaner\Components\Processor;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Interface ProcessorInterface
 * @package ShyimCleaner\Components\Processor
 */
interface ProcessorInterface extends ContainerAwareInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return int Affected rows
     */
    public function execute();
}