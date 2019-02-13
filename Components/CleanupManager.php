<?php

namespace FroshCleaner\Components;

use FroshCleaner\Components\Processor\ProcessorInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CleanupManager
 * @package FroshCleaner\Components
 */
class CleanupManager
{
    /**
     * @var ProcessorInterface[]
     */
    private $processors = [];

    /**
     * @param ContainerInterface $container
     * @param \IteratorAggregate $processors
     */
    public function __construct(\IteratorAggregate $processors)
    {
        $this->processors = iterator_to_array($processors, false);
    }

    /**
     * @return ProcessorInterface[]
     */
    public function getProcessors()
    {
        return $this->processors;
    }
}