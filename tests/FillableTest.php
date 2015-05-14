<?php

require_once __DIR__ . '/stubs/FillableMock.php';

class FillableTest extends PHPUnit_Framework_TestCase {

    public function testConstruct()
    {
        $mock = new FillableMock();
        $this->assertEmpty($mock->getAttributes());
    }

    public function testFill()
    {
        $mock = new FillableMock();

        $mock->fill(['foo' => 'bar']);
        $this->assertEquals(['foo' => 'bar'], $mock->getAttributes());

        $mock->fill(['foo' => 'baz', 'bar' => [0, 1]]);
        $this->assertEquals(['foo' => 'baz', 'bar' => [0, 1]], $mock->getAttributes());

        $mock->fill(['bar' => null]);
        $this->assertEquals(['foo' => 'baz', 'bar' => null], $mock->getAttributes());


        $mockChain = $mock->fill(['bar' => 1]);
        $this->assertInstanceOf('FillableMock', $mockChain);
        $this->assertEquals($mock, $mockChain);
    }

    public function testWith()
    {
        $mock = new FillableMock();

        $mock->with('foo', 'bar');
        $this->assertEquals(['foo' => 'bar'], $mock->getAttributes());

        $mock->with('foo', 'baz', false);
        $this->assertEquals(['foo' => 'bar'], $mock->getAttributes());

        $mock = new FillableMock();
        $mock->with(['bar' => ['test0' => 0, 'test1' => 1]]);
        $mock->with(['bar' => ['test0' => false, 'test2' => 2]], null, false);
        $this->assertEquals(['bar' => ['test0' => 0, 'test1' => 1]], $mock->getAttributes());

        $mock->with(['bar' => ['test0' => false, 'test2' => 2]]);
        $this->assertEquals(['bar' => ['test0' => false, 'test2' => 2]], $mock->getAttributes());

        $mockChain = $mock->with('bar', null);
        $this->assertInstanceOf('FillableMock', $mockChain);
        $this->assertEquals($mock, $mockChain);
    }
}
