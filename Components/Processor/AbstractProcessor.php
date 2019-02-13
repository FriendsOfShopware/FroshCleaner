<?php


namespace FroshCleaner\Components\Processor;

use Doctrine\DBAL\Connection;

abstract class AbstractProcessor implements ProcessorInterface
{
    /**
     * @var Connection
     */
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}