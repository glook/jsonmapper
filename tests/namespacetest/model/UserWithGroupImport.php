<?php
namespace glook\jsonmapper\tests\namespacetest\model;

use glook\jsonmapper\tests\othernamespace\{Foo, Programmers};

class UserWithGroupImport
{
    /** @var Foo */
    public $foo;

    /** @var Programmers */
    public $programmers;
}
