<?php

namespace ShyimCleaner\Commands;

use Shopware\Commands\ShopwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CleanupCommand
 * @package ShyimCleaner\Commands
 */
class CleanupCommand extends ShopwareCommand
{
    protected function configure()
    {
        $this
            ->setName('shyim:cleanup')
            ->setDescription('Like CCleaner but for Shopware ♥');
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container->get('shyim_cleaner.cleanup_manager')->run($input, $output);
    }
}