<?php

namespace FroshCleaner\Components\Processor;

class BackendSessionProcessor extends AbstractProcessor
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Cleanup backend session';
    }

    /**
     * @return int Affected rows
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute()
    {
        return $this->connection->executeUpdate('DELETE FROM s_core_sessions_backend WHERE modified < TIMESTAMP(DATE_SUB(NOW(), INTERVAL 2 DAY))');
    }
}