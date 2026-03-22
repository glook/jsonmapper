<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

/**
 * Unit test helper class for testing property mapping
 */
class FactoryMethod
{
    private $privateValue;

    /**
     * @var string
     */
    public $simple;

    /**
     * @factory glook\jsonmapper\tests\JsonMapperTest\FactoryMethod::createFromValue
     */
    public $value;

    /**
     * @var bool
     * @factory glook\jsonmapper\tests\JsonMapperTest\FactoryMethod::createFromInt
     */
    public $bool;

    /**
     * @factory glook\jsonmapper\tests\JsonMapperTest\FactoryMethod::createFromTimestamp
     */
    public $datetime;

    /**
     * @factory glook\jsonmapper\tests\JsonMapperTest\FactoryMethod::createObjectFromValue
     */
    public $object;

    /**
     * @factory glook\jsonmapper\tests\JsonMapperTest\FactoryMethod::createObjectFromValue
     */
    public $objObj;

    /**
     * @var int[]
     * @factory glook\jsonmapper\tests\JsonMapperTest\FactoryMethod::createArrayFromArray
     */
    public $array;

    /**
     * @var int
     * @factory glook\jsonmapper\tests\JsonMapperTest\FactoryMethod::createValueFromArray
     */
    public $valueArr;

    /**
     * @factory glook\jsonmapper\tests\JsonMapperTest\FactoryMethod::createFromValue
     */
    public function setPrivateValue($val)
    {
        $this->privateValue = $val;
    }

    public function getPrivateValue()
    {
        return $this->privateValue;
    }

    public static function createFromValue($value)
    {
        return 'value is ' . $value;
    }

    public static function createFromBoolStrict($value)
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('Only boolean types are allowed');
        }
        return 'value is ' . $value;
    }

    public static function createFromInt($value)
    {
        return $value === 1;
    }

    public static function createFromIntStrict($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Only integer types are allowed');
        }
        return $value === 1;
    }

    public static function createFromTimestamp($value)
    {
        return new \DateTime('@' . $value);
    }

    public static function createObjectFromValue($value)
    {
        return new ValueObject($value);
    }

    public static function createArrayFromArray($value)
    {
        return array_map('glook\jsonmapper\tests\JsonMapperTest\FactoryMethod::cube', $value);
    }

    public static function createValueFromArray($value)
    {
        $val = 0;
        for ($i=0; $i < count($value); $i++) {
            $val += $value[$i];
        }
        return $val;
    }

    public static function cube($n)
    {
        return($n * $n);
    }
}
