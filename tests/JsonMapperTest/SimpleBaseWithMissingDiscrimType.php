<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

/**
 * @discriminator type
 */
class SimpleBaseWithMissingDiscrimType
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
