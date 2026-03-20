<?php
namespace glook\jsonmapper\tests\namespacetest\model;

use DateTime;
use glook\jsonmapper\tests\othernamespace\Foo;
use glook\jsonmapper\tests\othernamespace\Foo as AliasedFoo;

class UserWithImports
{
    /** @var DateTime */
    public $createdAt;

    /** @var DateTime|null */
    public $updatedAt;

    /** @var \glook\jsonmapper\tests\othernamespace\Foo */
    public $foo;

    /** @var AliasedFoo */
    public $aliasedFoo;

    /** @var Foo[] */
    public $fooArray;


    /** @var Project */
    public $project;

}
