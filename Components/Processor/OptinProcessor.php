<?php

namespace FroshCleaner\Components\Processor;

class OptinProcessor extends AbstractProcessor
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Cleanup optin entries';
    }

    /**
     * @return int Affected rows
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute()
    {
        return $this->connection->executeUpdate('DELETE FROM s_core_optin WHERE datum < DATE_SUB(NOW(), INTERVAL 1 MONTH)');
    }
}