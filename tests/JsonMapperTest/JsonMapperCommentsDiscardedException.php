<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

use glook\jsonmapper\JsonMapperException;
use glook\jsonmapper\JsonMapper;

class JsonMapperCommentsDiscardedException extends JsonMapper
{
    /**
     * @throws JsonMapperException
     */
    function __construct($config)
    {
        $this->config = $config;

        $this->zendOptimizerPlusExtensionLoaded = true;

        parent::__construct();
    }
}
