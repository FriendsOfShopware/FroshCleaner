<?php

namespace FroshCleaner\Components\Processor;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class ShopProcessor
 * @package FroshCleaner\Components\Processor
 */
class ShopProcessor extends AbstractProcessor
{
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

        $rowCount += $this->connection->executeUpdate('DELETE FROM s_core_snippets WHERE shopID NOT IN(SELECT id FROM s_core_shops)');
        $rowCount += $this->connection->executeUpdate('DELETE FROM s_core_config_values WHERE shop_id NOT IN(SELECT id FROM s_core_shops)');
        $rowCount += $this->connection->executeUpdate('DELETE FROM s_core_translations WHERE objectlanguage NOT IN(SELECT id FROM s_core_shops)');
        $rowCount += $this->connection->executeUpdate('DELETE FROM s_core_paymentmeans_subshops WHERE subshopID NOT IN(SELECT id FROM s_core_shops)');
        $rowCount += $this->connection->executeUpdate('DELETE FROM s_core_shop_pages WHERE shop_id NOT IN(SELECT id FROM s_core_shops)');

        return $rowCount;
    }
}