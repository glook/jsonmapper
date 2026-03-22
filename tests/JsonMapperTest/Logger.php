<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

/**
 * Simple in-memory logger
 */
class Logger
{
    public $log = array();

    /**
     * Log a message to the $logger object
     *
     * @param string $level   Logging level
     * @param string $message Text to log
     * @param array  $context Additional information
     *
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $this->log[] = array($level, $message, $context);
    }
}
