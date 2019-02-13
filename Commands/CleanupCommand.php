<?php

namespace FroshCleaner\Commands;

use Shopware\Commands\ShopwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CleanupCommand
 * @package FroshCleaner\Commands
 */
class CleanupCommand extends ShopwareCommand
{
    protected function configure()
    {
        $this
            ->setName('frosh:cleanup')
            ->setDescription('Like CCleaner but for Shopware ♥');
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $processors = $this->container->get('shyim_cleaner.cleanup_manager')->getProcessors();

        $progress = new ProgressBar($output, count($processors));
        $progress->start();
        $affectedRows = [];

        foreach ($processors as $processor) {
            $progress->setMessage($processor->getName());
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