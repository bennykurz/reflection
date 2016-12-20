<?php
declare(strict_types=1);

/**
 * This file is part of N86io/Reflection.
 *
 * N86io/Reflection is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * N86io/Reflection is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with N86io/Reflection or see <http://www.gnu.org/licenses/>.
 */

namespace N86io\Reflection\Tests\Unit;

use N86io\Reflection\DocComment;
use N86io\Reflection\Exception\ReflectionPropertyException;
use N86io\Reflection\ReflectionProperty;
use N86io\Reflection\Tests\Unit\Stuff\TestClass;
use PHPUnit\Framework\TestCase;

/**
 * Class ReflectionPropertyTest
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionPropertyTest extends TestCase
{
    /**
     * @var \ReflectionProperty
     */
    protected $propertyOrig;

    /**
     * @var ReflectionProperty
     */
    protected $property;

    /**
     * @var ReflectionProperty
     */
    protected $property2;

    /**
     * @var ReflectionProperty
     */
    protected $property3;

    public function setUp()
    {
        $this->propertyOrig = new \ReflectionProperty(TestClass::class, 'attributes');
        $this->property = new ReflectionProperty(TestClass::class, 'attributes');
        $this->property2 = new ReflectionProperty(TestClass::class, 'property');
        $this->property3 = new ReflectionProperty(TestClass::class, 'boolValue');
    }

    public function testGetDeclaringClass()
    {
        $this->assertEquals(
            $this->propertyOrig->getDeclaringClass()->getName(),
            $this->property->getDeclaringClass()->getName()
        );
    }

    public function testHasGetter()
    {
        $this->assertTrue($this->property->hasGetter());
        $this->assertFalse($this->property2->hasGetter());
        $this->assertTrue($this->property3->hasGetter());
    }

    public function testGetGetter()
    {
        $this->assertEquals('getAttributes', $this->property->getGetter()->getName());
        $this->assertEquals('isBoolValue', $this->property3->getGetter()->getName());
    }

    public function testGetGetterException()
    {
        $this->expectException(ReflectionPropertyException::class);
        $this->property2->getGetter();
    }

    public function testHasSetter()
    {
        $this->assertFalse($this->property->hasSetter());
        $this->assertTrue($this->property2->hasSetter());
        $this->assertFalse($this->property3->hasSetter());
    }

    public function testGetSetter()
    {
        $this->assertEquals('setProperty', $this->property2->getSetter()->getName());
    }

    public function testGetSetterException()
    {
        $this->expectException(ReflectionPropertyException::class);
        $this->property->getSetter();
    }

    public function testGetParsedDocComment()
    {
        $this->assertTrue($this->property->getParsedDocComment() instanceof DocComment);
    }
}
