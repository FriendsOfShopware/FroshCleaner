<?php

namespace FroshCleaner\Components\Processor;

/**
 * Interface ProcessorInterface
 * @package FroshCleaner\Components\Processor
 */
interface ProcessorInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return int Affected rows
     */
    public function execute();
}