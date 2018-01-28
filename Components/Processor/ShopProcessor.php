<?php

namespace ShyimCleaner\Components\Processor;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class ShopProcessor
 * @package ShyimCleaner\Components\Processor
 */
class ShopProcessor implements ProcessorInterface
{
    use ContainerAwareTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'Cleanup entries in snippets, config with invalid shop association';
    }

    /**
     * @return int Affected rows
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute()
    {
        $rowCount = 0;

        $query = $this->container->get('dbal_connection')->executeQuery('DELETE FROM s_core_snippets WHERE shopID NOT IN(SELECT id FROM s_core_shops)');
        $query->execute();
        $rowCount += $query->rowCount();

        $query = $this->container->get('dbal_connection')->executeQuery('DELETE FROM s_core_config_values WHERE shop_id NOT IN(SELECT id FROM s_core_shops)');
        $query->execute();
        $rowCount += $query->rowCount();

        $query = $this->container->get('dbal_connection')->executeQuery('DELETE FROM s_core_translations WHERE objectlanguage NOT IN(SELECT id FROM s_core_shops)');
        $query->execute();
        $rowCount += $query->rowCount();

        $query = $this->container->get('dbal_connection')->executeQuery('DELETE FROM s_core_paymentmeans_subshops WHERE subshopID NOT IN(SELECT id FROM s_core_shops)');
        $query->execute();
        $rowCount += $query->rowCount();

        $query = $this->container->get('dbal_connection')->executeQuery('DELETE FROM s_core_shop_pages WHERE shop_id NOT IN(SELECT id FROM s_core_shops)');
        $query->execute();
        $rowCount += $query->rowCount();

        return $rowCount;
    }
}