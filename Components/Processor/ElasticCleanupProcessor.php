<?php

namespace FroshCleaner\Components\Processor;

class ElasticCleanupProcessor extends AbstractProcessor
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
        $rowCount = $this->connection->executeUpdate('DELETE FROM s_es_backend_backlog');
        $rowCount += $this->connection->executeUpdate('DELETE FROM s_es_backlog');

        $this->connection->executeUpdate('TRUNCATE TABLE s_es_backend_backlog');
        $this->connection->executeUpdate('TRUNCATE TABLE s_es_backlog');

        return $rowCount;
    }
}