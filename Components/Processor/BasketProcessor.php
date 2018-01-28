<?php

namespace ShyimCleaner\Components\Processor;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class BasketProcessor
 * @package ShyimCleaner\Components\Processor
 */
class BasketProcessor implements ProcessorInterface
{
    use ContainerAwareTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'Cleanup old basket entries';
    }

    /**
     * @return int Affected rows
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute()
    {
        $query = $this->container->get('dbal_connection')->executeQuery('DELETE FROM s_order_basket WHERE datum < DATE_SUB(NOW(), INTERVAL 1 YEAR)');
        $query->execute();
        return $query->rowCount();
    }
}