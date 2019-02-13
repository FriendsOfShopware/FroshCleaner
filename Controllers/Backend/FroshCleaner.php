<?php


class Shopware_Controllers_Backend_FroshCleaner extends Shopware_Controllers_Backend_ExtJs
{
    public function preDispatch()
    {
        parent::preDispatch();
        $this->View()->addTemplateDir($this->container->getParameter('frosh_cleaner.view_dir'));
    }

    public function processorsAction()
    {
        $processors = [];
        $cleanupManager = $this->container->get('shyim_cleaner.cleanup_manager');
        $namespace = $this->get('snippets')->getNamespace('backend/frosh_cleaner/main');

        foreach ($cleanupManager->getProcessors() as $processor) {
            $processors[] = [
                'id' => get_class($processor),
                'name' => $namespace->get(get_class($processor), $processor->getName(), true),
            ];
        }

        $this->View()->assign('success', true);
        $this->View()->assign('data', $processors);
    }

    public function processAction()
    {
        $process = $this->Request()->getParam('process');
        $cleanupManager = $this->container->get('shyim_cleaner.cleanup_manager');

        foreach ($cleanupManager->getProcessors() as $processor) {
            if (get_class($processor) === $process) {
                $this->View()->assign('success', true);
                $this->View()->assign('affectedRows', $processor->execute());
            }
        }
    }
}