<?php
require __DIR__ . '/../main.php';

use PHPUnit\Framework\TestCase;
use SortedLinkedList\SortedLinkedList;
use SortedLinkedList\ElementNotFoundException;

class SortedLinkedListTest extends TestCase
{
    public function testAdd()
    {
        $intList = new SortedLinkedList('int');
        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $this->assertEquals('2, 5, 6', (string) $intList);
    }

    public function testRemove()
    {
        $intList = new SortedLinkedList('int');
        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $intList->removeByIndex(1);
        $this->assertEquals('2, 6', (string) $intList);

        $this->expectException(ElementNotFoundException::class);
        $intList->removeByIndex(3);
    }

    public function testContains()
    {
        $intList = new SortedLinkedList('int');
        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $this->assertTrue($intList->contains(5));
        $this->assertFalse($intList->contains(3));
    }

    public function testSize()
    {
        $intList = new SortedLinkedList('int');
        $this->assertEquals(0, $intList->size());

        $intList->add(5);
        $intList->add(2);
        $intList->add(6);
        $this->assertEquals(3, $intList->size());
    }

    public function testGet()
    {
        $intList = new SortedLinkedList('int');
        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $this->assertEquals(2, $intList->get(0));
        $this->assertEquals(5, $intList->get(1));
        $this->assertEquals(6, $intList->get(2));

        $this->expectException(ElementNotFoundException::class);
        $intList->get(3);
    }


    public function testGetFirst()
    {
        $intList = new SortedLinkedList('int');
        $this->expectException(ElementNotFoundException::class);
        $intList->getFirst();

        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $this->assertEquals(2, $intList->getFirst());
    }

    public function testClear()
    {
        $intList = new SortedLinkedList('int');
        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $this->assertEquals(3, $intList->size());
        $intList->clear();
        $this->assertEquals(0, $intList->size());
        $this->assertEquals('', (string) $intList);
    }

    public function testRemoveByValue()
    {
        $intList = new SortedLinkedList('int');
        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $intList->remove(2);
        $this->assertEquals('5, 6', (string) $intList);

        $this->expectException(ElementNotFoundException::class);
        $intList->remove(3);
    }

    public function testIsEmpty()
    {
        $intList = new SortedLinkedList('int');
        $this->assertTrue($intList->isEmpty());

        $intList->add(5);
        $this->assertFalse($intList->isEmpty());
    }

    public function testGetLast()
    {
        $intList = new SortedLinkedList('int');
        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $this->assertEquals(6, $intList->getLast());
    }

    public function testToArray()
    {
        $intList = new SortedLinkedList('int');
        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $this->assertEquals([2, 5, 6], $intList->toArray());
    }

    public function testInvalidDataType()
    {
        $this->expectException(InvalidArgumentException::class);
        $intList = new SortedLinkedList('float');
    }

    public function testAddString()
    {
        $stringList = new SortedLinkedList('string');
        $stringList->add('banana');
        $stringList->add('apple');
        $stringList->add('orange');

        $this->assertEquals('apple, banana, orange', (string) $stringList);
    }

    public function testRemoveByValueString()
    {
        $stringList = new SortedLinkedList('string');
        $stringList->add('banana');
        $stringList->add('apple');
        $stringList->add('orange');

        $stringList->remove('apple');
        $this->assertEquals('banana, orange', (string) $stringList);

        $this->expectException(ElementNotFoundException::class);
        $stringList->remove('grape');
    }

    public function testAddOrder()
    {
        $intList = new SortedLinkedList('int');
        $intList->add(5);
        $intList->add(2);
        $intList->add(6);

        $this->assertEquals('2, 5, 6', (string) $intList);

        $stringList = new SortedLinkedList('string');
        $stringList->add('banana');
        $stringList->add('apple');
        $stringList->add('orange');

        $this->assertEquals('apple, banana, orange', (string) $stringList);
    }

    public function testRemoveFromEmptyList()
    {
        $intList = new SortedLinkedList('int');
        $this->expectException(ElementNotFoundException::class);
        $intList->remove(5);
    }

    public function testGetFromEmptyList()
    {
        $intList = new SortedLinkedList('int');
        $this->expectException(ElementNotFoundException::class);
        $intList->get(0);
    }


}