<?php
namespace namespacetest\model;

use DateTime;
use othernamespace\Foo;
use othernamespace\Foo as AliasedFoo;

class UserWithImports
{
    /** @var DateTime */
    public $createdAt;

    /** @var DateTime|null */
    public $updatedAt;

    /** @var Foo */
    public $foo;

    /** @var AliasedFoo */
    public $aliasedFoo;

    /** @var Foo[] */
    public $fooArray;
}
