<?php
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

namespace N86io\Reflection\Tests;

use N86io\Reflection\ReflectionClass;
use N86io\Reflection\Tests\Stuff\AbstractTestClass;
use N86io\Reflection\Tests\Stuff\TestClass;
use N86io\Reflection\Tests\Stuff\TestClassInterface;
use N86io\Reflection\Tests\Stuff\TestTrait;

/**
 * Class ReflectionClassTest
 * @package N86io\Reflection\Tests
 */
class ReflectionClassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \ReflectionClass
     */
    protected $reflectionOriginal;

    /**
     * @var ReflectionClass
     */
    protected $reflection;

    public function setUp()
    {
        $this->reflectionOriginal = new \ReflectionClass(TestClass::class);
        $this->reflection = new ReflectionClass(TestClass::class);
    }

    public function testGetInterfaces()
    {
        $this->assertEquals(
            $this->reflection->getInterfaces()[TestClassInterface::class]->getName(),
            $this->reflection->getInterfaces()[TestClassInterface::class]->getName()
        );
    }

    public function testGetParentClass()
    {
        $this->assertEquals(
            $this->reflectionOriginal->getParentClass()->getName(),
            $this->reflection->getParentClass()->getName()
        );
    }

    public function testGetTraits()
    {
        $this->assertEquals(
            $this->reflectionOriginal->getTraits()[TestTrait::class]->getName(),
            $this->reflection->getTraits()[TestTrait::class]->getName()
        );
    }

    public function testGetConstructor()
    {
        $this->assertEquals(
            $this->reflectionOriginal->getConstructor()->getName(),
            $this->reflection->getConstructor()->getName()
        );
        $reflection = new ReflectionClass(AbstractTestClass::class);
        $this->assertNull($reflection->getConstructor());
    }

    public function testGetMethods()
    {
        $this->assertEquals(
            $this->reflectionOriginal->getMethods()[1]->getName(),
            $this->reflection->getMethods()[1]->getName()
        );
    }

    public function testGetMethod()
    {
        $this->assertEquals(
            $this->reflectionOriginal->getMethod('method')->getName(),
            $this->reflection->getMethod('method')->getName()
        );
    }

    public function testGetProperties()
    {
        $this->assertEquals(
            $this->reflectionOriginal->getProperties()[0]->getName(),
            $this->reflection->getProperties()[0]->getName()
        );
    }

    public function testGetProperty()
    {
        $this->assertEquals(
            $this->reflectionOriginal->getProperty('attributes')->getName(),
            $this->reflection->getProperty('attributes')->getName()
        );
    }
}
