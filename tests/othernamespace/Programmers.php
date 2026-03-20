<?php

namespace glook\jsonmapper\tests\othernamespace;

use glook\jsonmapper\tests\namespacetest\model\Group;

class Programmers extends Group
{
    /**
     * @maps language
     * @var string
     */
    public $language;

    /**
     * @maps languageUser
     * @var \glook\jsonmapper\tests\namespacetest\model\User
     */
    public $languageUser;
}
