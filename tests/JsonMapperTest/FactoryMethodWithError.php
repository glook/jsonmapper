<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

/**
 * Unit test helper class for testing property mapping
 */
class FactoryMethodWithError
{
    /**
     * @factory NonExistentMethod
     */
    public $simple;
}
