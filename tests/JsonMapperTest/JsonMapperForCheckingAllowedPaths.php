<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

use glook\jsonmapper\JsonMapper;

class JsonMapperForCheckingAllowedPaths extends JsonMapper
{
    function isPathAllowed($filePath, $allowedPaths)
    {
        return parent::isPathAllowed($filePath, $allowedPaths);
    }
}
