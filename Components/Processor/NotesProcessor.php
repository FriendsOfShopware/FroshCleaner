<?php

namespace FroshCleaner\Components\Processor;

class NotesProcessor extends AbstractProcessor
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Cleanup old notes entries';
    }

    public function execute()
    {
        return $this->connection->executeUpdate('DELETE FROM s_order_notes WHERE datum < DATE_SUB(NOW(), INTERVAL 1 YEAR)');
    }
}