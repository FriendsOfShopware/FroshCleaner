<?php

namespace ShyimCleaner\Components\Processor;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class NotesProcessor
 * @package ShyimCleaner\Components\Processor
 */
class NotesProcessor implements ProcessorInterface
{
    use ContainerAwareTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'Cleanup old notes entries';
    }

    /**
     * @return int Affected rows
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute()
    {
        $query = $this->container->get('dbal_connection')->executeQuery('DELETE FROM s_order_notes WHERE datum < DATE_SUB(NOW(), INTERVAL 1 YEAR)');
        $query->execute();
        return $query->rowCount();
    }
}