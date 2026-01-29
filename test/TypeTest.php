<?php

use AstroStudio\Core\Type;
use PHPUnit\Framework\TestCase;


interface TypeTestInterface
{

}

class TypeTestClass implements Stringable, TypeTestInterface {
    public function __toString(): string
    {
        return self::class;
    }

    public function __invoke(){

    }
}

class TypeTest extends TestCase
{
    public function testList(){
        self::assertEquals(['test'], Type::list('test'));
        self::assertEquals(['test1','test2'], Type::list('test1|test2'));
        self::assertEquals(['test1','test2'], Type::list(['test1','test2']));
    }

    public function testGet(){
        $testObject = new TypeTestClass();

        self::assertEquals(Type::NULL,Type::get(null));
        self::assertEquals(Type::INTEGER,Type::get(23));
        self::assertEquals(Type::STRING,Type::get('raz'));
        self::assertEquals(Type::BOOLEAN,Type::get(false));
        self::assertEquals(Type::FLOAT,Type::get(23.4));
        self::assertEquals(Type::ARRAY,Type::get([]));

        self::assertEquals(Type::OBJECT,Type::get($testObject, true));
        self::assertEquals(TypeTestClass::class, Type::get($testObject));
        self::assertEquals(Type::CALLABLE, Type::get($testObject, true, true));
        self::assertEquals(Type::CALLABLE, Type::get($testObject, false, true));

        self::assertEquals(Closure::class, Type::get(function(){}));
        self::assertEquals(Type::OBJECT, Type::get(function(){}, true));
        self::assertEquals(Type::CALLABLE, Type::get(function(){}, true, true));
        self::assertEquals(Type::CALLABLE, Type::get(function(){}, false, true));

        self::assertEquals(Type::RESOURCE, Type::get(stream_context_create()));

    }

    public function testIs(){
        $testObject = new TypeTestClass();

        self::assertTrue(Type::is(null, Type::NULL));
        self::assertTrue(Type::is(23,Type::INTEGER));
        self::assertTrue(Type::is('raz',Type::STRING));
        self::assertTrue(Type::is(false,Type::BOOLEAN));
        self::assertTrue(Type::is(23.4,Type::FLOAT));
        self::assertTrue(Type::is($testObject, Type::OBJECT, true));
        self::assertTrue(Type::is([],Type::ARRAY));
        self::assertTrue(Type::is($testObject, TypeTestClass::class));
        self::assertTrue(Type::is($testObject, Stringable::class));
        self::assertTrue(Type::is($testObject, TypeTestInterface::class));

        self::assertTrue(Type::is());
        self::assertTrue(Type::is(23));
        self::assertTrue(Type::is('raz'));
        self::assertTrue(Type::is(false));
        self::assertTrue(Type::is(23.4));
        self::assertTrue(Type::is($testObject, Type::ANY, false));
        self::assertTrue(Type::is([]));
        self::assertTrue(Type::is($testObject));

        self::assertTrue(Type::is(stream_context_create(),Type::RESOURCE));

        self::assertFalse(Type::is(23,[]));
        self::assertFalse(Type::is(23, 'float|boolean'));
        self::assertFalse(Type::is(23,[Type::FLOAT,Type::BOOLEAN]));
        self::assertTrue(Type::is(23, 'float|integer'));
        self::assertTrue(Type::is(23,[Type::FLOAT,Type::INTEGER]));
        self::assertTrue(Type::is($testObject, [Type::ARRAY,TypeTestInterface::class]));
    }

    public function testAssert(){
        self::expectException(InvalidArgumentException::class);

        Type::assert(23, Type::FLOAT);
    }
}