<?php

namespace glook\jsonmapper\tests\namespacetest\model;

use ArrayObject;

class UserWithArrayObject
{
    /** @var ArrayObject */
    public $items;

    /** @var ArrayObject[User] */
    public $typedItems;

    /** @var ArrayObject[int] */
    public $simpleItems;
}
