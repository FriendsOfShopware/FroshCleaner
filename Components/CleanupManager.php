<?php

namespace ShyimCleaner\Components;

use ShyimCleaner\Components\Processor\ProcessorInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CleanupManager
 * @package ShyimCleaner\Components
 */
class CleanupManager
{
    /**
     * @var ProcessorInterface[]
     */
    private $processors = [];

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * CleanupManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param ProcessorInterface $processor
     */
    public function addProcessor(ProcessorInterface $processor)
    {
        $this->processors[] = $processor;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $progress = new ProgressBar($output, count($this->processors));
        $progress->start();
        $affectedRows = [];

        foreach ($this->processors as $processor) {
            $progress->setMessage($processor->getName());
            $processor->setContainer($this->container);
            $affectedRows[] = [$processor->getName(), $processor->execute()];
            $progress->advance();
        }

        $progress->finish();
        $output->writeln('');

        $table = new Table($output);
        $table->setHeaders(['Name', 'Affected rows']);
        $table->setRows($affectedRows);
        $table->render();
    }
}