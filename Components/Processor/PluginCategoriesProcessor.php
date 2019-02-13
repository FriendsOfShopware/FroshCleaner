<?php

namespace FroshCleaner\Components\Processor;

class PluginCategoriesProcessor extends AbstractProcessor
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Cleanup plugin categories';
    }

    /**
     * @return int Affected rows
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute()
    {
        $rowCount = $this->connection->executeUpdate('DELETE FROM s_core_plugin_categories');
        $rowCount += $this->connection->executeUpdate('TRUNCATE TABLE s_core_plugin_categories');

        return $rowCount;
    }
}