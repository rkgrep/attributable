<?php

require_once __DIR__ . '/stubs/AttributableMock.php';

class AttributableTest extends PHPUnit_Framework_TestCase {

    public function testConstruct()
    {
        $mock = new AttributableMock();
        $this->assertEmpty($mock->toArray());
    }

    public function testSetAndGet()
    {
        $mock = new AttributableMock();

        $mock->foo = 'bar';

        $this->assertEquals('bar', $mock->get('foo'));
        $this->assertEquals('bar', $mock->foo);
        $this->assertNull($mock->get('baz'));
    }

    public function testIsset()
    {
        $mock = new AttributableMock();

        $mock->foo = 'bar';
        $this->assertTrue(isset($mock->foo));
        $this->assertFalse(isset($mock->baz));
    }

    public function testCall()
    {
        $mock = new AttributableMock();

        $mock->foo();
        $this->assertTrue($mock->get('foo'));

        $mock->foo('bar');
        $this->assertEquals('bar', $mock->get('foo'));
    }

    public function testUnset()
    {
        $mock = new AttributableMock();
        $mock['foo'] = 'bar';

        unset($mock['foo']);
        $this->assertFalse($mock->offsetExists('foo'));
    }
}
