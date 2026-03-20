<?php
namespace glook\jsonmapper\tests\JsonMapperTest;

class Php7TypedClass
{
    private $name;
    private $age;
    private $value;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setAge(int $age)
    {
        $this->age = $age;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setValue(ValueObject $value)
    {
        $this->value = $value;
    }

    public function getValue(): ValueObject
    {
        return $this->value;
    }
}
