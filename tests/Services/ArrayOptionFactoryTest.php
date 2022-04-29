<?php

namespace WalkerChiu\Core\Tests\Services;

use WalkerChiu\Core\Models\Services\ArrayOptionFactory;

class ArrayOptionFactoryTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Test whether delimiters can be set and retrieved correctly.
     *
     * @return void
     */
    public function testSettingAndGettingDelimiters()
    {
        $factory = new ArrayOptionFactory();
        $factory->setDelimiterBefore('_');
        $factory->setDelimiterAfter('-');

        $this->assertSame('_', $factory->getDelimiterBefore());
        $this->assertSame('-', $factory->getDelimiterAfter());
    }

    /**
     * Test that an exception is thrown for invalid input during key transformation.
     *
     * @return void
     */
    public function testExceptionForInvalidInputInKeyTransformation()
    {
        $this->expectException(\TypeError::class);

        $factory = new ArrayOptionFactory('_', '-');
        $factory->transformKey(123);
    }

    /**
     * Test that an exception is thrown for invalid input during value transformation.
     *
     * @return void
     */
    public function testExceptionForInvalidInputInValueTransformation()
    {
        $this->expectException(\TypeError::class);

        $factory = new ArrayOptionFactory('_', '-');
        $factory->transformValue(123);
    }

    /**
     * Test whether keys in an array can be transformed as expected.
     *
     * @return void
     */
    public function testTransformingKeysInArray()
    {
        $array = [
            'key_one' => 'value_one',
            'key_two' => 'value_two',
        ];

        $factory = new ArrayOptionFactory('_', '-');
        $transformedArray = $factory->transformKey($array);

        $this->assertSame([
            'key-one' => 'value_one',
            'key-two' => 'value_two',
        ], $transformedArray);
    }

    /**
     * Test whether values in an array can be transformed as expected.
     *
     * @return void
     */
    public function testTransformingValuesInArray()
    {
        $array = ['value_one', 'value_two'];

        $factory = new ArrayOptionFactory('_', '-');
        $transformedArray = $factory->transformValue($array);

        $this->assertSame(['value-one', 'value-two'], $transformedArray);
    }
}
