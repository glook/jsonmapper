<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

class Php7_1TypedClass
{
    private $nullableArray;

    /**
     * @param ValueObject[]|null $val
     */
    public function setNullableArray(?array $val)
    {
        $this->nullableArray = $val;
    }

    public function getNullableArray()
    {
        return $this->nullableArray;
    }
}
