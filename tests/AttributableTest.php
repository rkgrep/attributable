<?php

require __DIR__ . '/stubs/Mock.php';

class AttributableTest extends PHPUnit_Framework_TestCase {

    public function testConstruct()
    {
        $mock = new Mock();
        $this->assertEmpty($mock->toArray());
    }

    public function testSetAndGet()
    {
        $mock = new Mock();

        $mock->foo = 'bar';

        $this->assertEquals('bar', $mock->get('foo'));
        $this->assertEquals('bar', $mock->foo);
        $this->assertNull($mock->get('baz'));
    }

    public function testIsset()
    {
        $mock = new Mock();

        $mock->foo = 'bar';
        $this->assertTrue(isset($mock->foo));
        $this->assertFalse(isset($mock->baz));
    }

    public function testCall()
    {
        $mock = new Mock();

        $mock->foo();
        $this->assertTrue($mock->get('foo'));

        $mock->foo('bar');
        $this->assertEquals('bar', $mock->get('foo'));
    }

    public function testUnset()
    {
        $mock = new Mock();
        $mock['foo'] = 'bar';

        unset($mock['foo']);
        $this->assertFalse($mock->offsetExists('foo'));
    }
}
