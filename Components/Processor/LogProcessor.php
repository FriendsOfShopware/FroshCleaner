<?php

namespace FroshCleaner\Components\Processor;

class LogProcessor extends AbstractProcessor
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Cleanup old log entries';
    }

    /**
     * @return int Affected rows
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute()
    {
        return $this->connection->executeUpdate('DELETE FROM s_core_log WHERE date < DATE_SUB(NOW(), INTERVAL 1 YEAR)');
    }
}