<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

use ArrayObject;

/**
 * Unit test helper class for testing property mapping
 */
class ArrayFixture
{

    /**
     * @var float[]
     */
    public $flArray;

    /**
     * @var string[]
     */
    public $strArray;

    /**
     * @var array<string|null>
     */
    public $nullableStrArray;

    /**
     * @var array<string,string>
     */
    public $strMap;

    /**
     * @var array<string,string[]>
     */
    public $strMapOfArray;

    /**
     * @var array<string,string>[]
     */
    public $strArrayOfMap;

    /**
     * @var Simple[]
     * @see http://phpdoc.org/docs/latest/references/phpdoc/types.html#arrays
     */
    public $typedArray;

    /**
     * @var array<Simple|null>
     * @see http://phpdoc.org/docs/latest/references/phpdoc/types.html#arrays
     */
    public $nullableTypedArray;

    /**
     * @var array<string,Simple>
     * @see http://phpdoc.org/docs/latest/references/phpdoc/types.html#arrays
     */
    public $typedMap;

    /**
     * @var array<string,Simple>[]
     * @see http://phpdoc.org/docs/latest/references/phpdoc/types.html#arrays
     */
    public $typedArrayOfMap;

    /**
     * @var \DateTime[]
     */
    public $typedSimpleArray;

    /**
     * This generates an array object with original json values
     * @var ArrayObject
     */
    public $pArrayObject;

    /**
     * This generates an array object with Simple instances
     * @var ArrayObject[Simple]
     */
    public $pTypedArrayObject;

    /**
     * @var ArrayObject[int]
     */
    public $pSimpleArrayObject;

}
