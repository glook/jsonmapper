<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

use ArrayObject;

/**
 * Unit test helper class for testing property mapping
 */
class Broken
{
    /**
     * @var ArrayObject[ThisClassDoesNotExist]
     */
    public $pTypedArrayObjectNoClass;

    /**
     *
     * @var string
     * @required
     */
    public $pMissingData;
}
