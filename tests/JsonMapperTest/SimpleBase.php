<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

/**
 * @discriminator type
 * @discriminatorType base
 */
class SimpleBase
{
    public $afield;

    public $bfield;

    public $type;

    /**
     * Embedded
     * @var SimpleBase
     */
    public $embedded;

    /**
     * Embedded array
     * @var SimpleBase[]
     */
    public $embeddedArray;
}
