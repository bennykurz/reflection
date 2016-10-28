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

use N86io\Reflection\ReflectionMethod;
use N86io\Reflection\Tests\Stuff\TestClass;

/**
 * Class ReflectionMethodTest
 * @package N86io\Reflection\Tests
 */
class ReflectionMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \ReflectionMethod
     */
    protected $reflectionMethodOrig;
    /**
     * @var ReflectionMethod
     */
    protected $reflectionMethod;

    public function setUp()
    {
        $this->reflectionMethodOrig = new \ReflectionMethod(TestClass::class, 'method');
        $this->reflectionMethod = new ReflectionMethod(TestClass::class, 'method');
    }

    public function testGetDeclaringClass()
    {
        $this->assertEquals(
            $this->reflectionMethodOrig->getName(),
            $this->reflectionMethod->getName()
        );
    }

    public function testGetClosureScopeClass()
    {
        $this->assertEquals(
            $this->reflectionMethodOrig->getClosureScopeClass(),
            $this->reflectionMethod->getClosureScopeClass()
        );
    }

    public function testGetParameters()
    {
        $this->assertEquals(
            $this->reflectionMethodOrig->getParameters()[0]->getName(),
            $this->reflectionMethod->getParameters()[0]->getName()
        );
    }

    public function testGetPrototype()
    {
        $this->assertEquals(
            $this->reflectionMethodOrig->getPrototype()->getName(),
            $this->reflectionMethod->getPrototype()->getName()
        );
    }
}
