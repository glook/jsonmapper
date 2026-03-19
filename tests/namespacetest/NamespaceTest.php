<?php
namespace namespacetest;
require_once __DIR__ . '/Unit.php';
require_once __DIR__ . '/UnitData.php';
require_once __DIR__ . '/model/User.php';
require_once __DIR__ . '/model/Group.php';
require_once __DIR__ . '/model/UserList.php';
require_once __DIR__ . '/../othernamespace/Programmers.php';
require_once __DIR__ . '/../othernamespace/Foo.php';
require_once __DIR__ . '/model/UserWithImports.php';
require_once __DIR__ . '/model/UserWithGroupImport.php';

use glook\jsonmapper\JsonMapper;
use glook\jsonmapper\JsonMapperException;
use namespacetest\model\User;
use namespacetest\model\UserWithImports;
use namespacetest\model\UserWithGroupImport;
use othernamespace\Programmers;

/**
 * @covers \glook\jsonmapper\JsonMapper
 * @covers \glook\jsonmapper\TypeCombination
 * @covers \glook\jsonmapper\JsonMapperException
 */
class NamespaceTest extends \PHPUnit\Framework\TestCase
{
    public function testMapArrayNamespace()
    {
        $mapper = new JsonMapper();
        $json = '{"data":[{"value":"1.2"}]}';
        $res = $mapper->map(json_decode($json), new UnitData());
        $this->assertInstanceOf('\namespacetest\UnitData', $res);
        $this->assertInstanceOf('\namespacetest\Unit', $res->data[0]);
    }

    public function testMapSimpleArrayNamespace()
    {
        $mapper = new JsonMapper();
        $json = '{"units":[{"value":"1.2"}]}';
        $res = $mapper->map(json_decode($json), new UnitData());
        $this->assertInstanceOf('\namespacetest\UnitData', $res);
        $this->assertInstanceOf('\namespacetest\Unit', $res->units[0]);
    }

    public function testMapSimpleStringArrayNamespace()
    {
        $mapper = new JsonMapper();
        $json = '{"messages":["message 1", "message 2"]}';
        $res = $mapper->map(json_decode($json), new UnitData());
        $this->assertInstanceOf('\namespacetest\UnitData', $res);
        $this->assertNotNull($res->messages);
        $this->assertCount(2, $res->messages);
    }

    public function testMapChildClassNamespace()
    {
        $mapper = new JsonMapper();
        $json = '{"user":{"name": "John Smith"}}';
        $res = $mapper->map(json_decode($json), new UnitData());
        $this->assertInstanceOf('\namespacetest\UnitData', $res);
        $this->assertInstanceOf('\namespacetest\model\User', $res->user);
    }

    public function testMapChildClassConstructorNamespace()
    {
        $mapper = new JsonMapper();
        $json = '{"user":"John Smith"}';
        $res = $mapper->map(json_decode($json), new UnitData());
        $this->assertInstanceOf('\namespacetest\UnitData', $res);
        $this->assertInstanceOf('\namespacetest\model\User', $res->user);
    }

    public function testMapChildObjectArrayNamespace()
    {
        $mapper = new JsonMapper();
        $json = '{"data":null,"user":{"name": "John Smith"}}';
        /* @var \namespacetest\UnitData $res */
        $res = $mapper->map(json_decode($json), new UnitData());
        $this->assertNull($res->data);
        $this->assertInstanceOf('\namespacetest\model\User', $res->user);
    }

    public function testMapEmpty()
    {
        $this->expectException(JsonMapperException::class);
        $this->expectExceptionMessage("Empty type at property 'namespacetest\UnitData::\$empty'");
        $mapper = new JsonMapper();
        $json = '{"empty":{}}';
        /* @var \namespacetest\UnitData $res */
        $res = $mapper->map(json_decode($json), new UnitData());
    }

    public function testMapCustomArraObjectWithChildType()
    {
        $mapper = new JsonMapper();
        $json = '{"users":[{"user":"John Smith"}]}';
        $res = $mapper->map(json_decode($json), new UnitData());
        $this->assertInstanceOf('\namespacetest\UnitData', $res);
        $this->assertInstanceOf('\namespacetest\model\UserList', $res->users);
        $this->assertInstanceOf('\namespacetest\model\User', $res->users[0]);
    }

    /**
     * Test a setter method with a namespaced type hint that
     * is within another namespace than the object itself.
     */
    public function testSetterNamespacedTypeHint()
    {
        $mapper = new JsonMapper();
        $json = '{"namespacedTypeHint":"Foo"}';
        $res = $mapper->map(json_decode($json), new UnitData());
        $this->assertInstanceOf('\namespacetest\UnitData', $res);
        $this->assertInstanceOf(
            '\othernamespace\Foo', $res->internalData['namespacedTypeHint']
        );
        $this->assertEquals(
            'Foo', $res->internalData['namespacedTypeHint']->name
        );
    }

    /**
     * Test a setter method with a namespaced type hint that
     * is within another namespace than the object itself.
     */
    public function testParentInDifferentNamespace()
    {
        $mapper = new JsonMapper();
        $json = '{"language":"PHP","languageUser":{"name":"phpUser"},"lead":{"name":"phpLead"},"users":[{"name":"member1"},{"name":"member2"}]}';
        $res = $mapper->mapClass(json_decode($json), Programmers::class);
        $this->assertInstanceOf(Programmers::class, $res);
        $this->assertEquals('PHP', $res->language);
        $this->assertInstanceOf(User::class, $res->languageUser);
        $this->assertEquals('phpUser', $res->languageUser->name);
        $this->assertInstanceOf(User::class, $res->lead);
        $this->assertEquals('phpLead', $res->lead->name);
        $this->assertTrue(is_array($res->getUsers()));
        $this->assertEquals('member1', $res->getUsers()[0]->name);
        $this->assertEquals('member2', $res->getUsers()[1]->name);
    }

    /**
     * Test that @var DateTime with use DateTime resolves to \DateTime.
     */
    public function testUseImportGlobalClass()
    {
        $mapper = new JsonMapper();
        $json = '{"createdAt":"2024-01-15T10:30:00+00:00"}';
        $res = $mapper->map(
            json_decode($json), new UserWithImports()
        );
        $this->assertInstanceOf('\DateTime', $res->createdAt);
    }

    /**
     * Test that @var DateTime|null with null value returns null.
     */
    public function testUseImportNullable()
    {
        $mapper = new JsonMapper();
        $json = '{"createdAt":"2024-01-15T10:30:00+00:00","updatedAt":null}';
        $res = $mapper->map(
            json_decode($json), new UserWithImports()
        );
        $this->assertInstanceOf('\DateTime', $res->createdAt);
        $this->assertNull($res->updatedAt);
    }

    /**
     * Test that @var Foo with use othernamespace\Foo resolves correctly.
     */
    public function testUseImportCrossNamespace()
    {
        $mapper = new JsonMapper();
        $json = '{"foo":{"name":"bar"}}';
        $res = $mapper->map(
            json_decode($json), new UserWithImports()
        );
        $this->assertInstanceOf('\othernamespace\Foo', $res->foo);
        $this->assertEquals('bar', $res->foo->name);
    }

    /**
     * Test that @var AliasedFoo with use ... as AliasedFoo resolves.
     */
    public function testUseImportAlias()
    {
        $mapper = new JsonMapper();
        $json = '{"aliasedFoo":{"name":"baz"}}';
        $res = $mapper->map(
            json_decode($json), new UserWithImports()
        );
        $this->assertInstanceOf('\othernamespace\Foo', $res->aliasedFoo);
        $this->assertEquals('baz', $res->aliasedFoo->name);
    }

    /**
     * Test that @var Foo[] with use othernamespace\Foo resolves array type.
     */
    public function testUseImportArray()
    {
        $mapper = new JsonMapper();
        $json = '{"fooArray":[{"name":"a"},{"name":"b"}]}';
        $res = $mapper->map(
            json_decode($json), new UserWithImports()
        );
        $this->assertCount(2, $res->fooArray);
        $this->assertInstanceOf('\othernamespace\Foo', $res->fooArray[0]);
        $this->assertEquals('a', $res->fooArray[0]->name);
        $this->assertEquals('b', $res->fooArray[1]->name);
    }

    /**
     * Test group import syntax: use othernamespace\{Foo, Programmers}.
     *
     * @requires PHP 7.0
     */
    public function testUseImportGroupSyntax()
    {
        $mapper = new JsonMapper();
        $json = '{"foo":{"name":"grouped"}}';
        $res = $mapper->map(
            json_decode($json), new UserWithGroupImport()
        );
        $this->assertInstanceOf('\othernamespace\Foo', $res->foo);
        $this->assertEquals('grouped', $res->foo->name);
    }

    /**
     * Test that existing namespace resolution (model\User) still works.
     */
    public function testExistingNamespaceResolutionUnchanged()
    {
        $mapper = new JsonMapper();
        $json = '{"user":{"name": "Jane"}}';
        $res = $mapper->map(json_decode($json), new UnitData());
        $this->assertInstanceOf('\namespacetest\model\User', $res->user);
        $this->assertEquals('Jane', $res->user->name);
    }

    /**
     * Test that parseUseStatements returns expected import map.
     */
    public function testParseUseStatements()
    {
        $mapper = new JsonMapper();
        $rc = new \ReflectionClass(UserWithImports::class);
        $filePath = $rc->getFileName();

        // Use reflection to call protected method
        $method = new \ReflectionMethod($mapper, 'parseUseStatements');
        if (PHP_VERSION_ID < 80100) {
            $method->setAccessible(true);
        }
        $imports = $method->invoke($mapper, $filePath);

        $this->assertArrayHasKey('DateTime', $imports);
        $this->assertEquals('\DateTime', $imports['DateTime']);
        $this->assertArrayHasKey('Foo', $imports);
        $this->assertEquals('\othernamespace\Foo', $imports['Foo']);
        $this->assertArrayHasKey('AliasedFoo', $imports);
        $this->assertEquals('\othernamespace\Foo', $imports['AliasedFoo']);
    }
}
