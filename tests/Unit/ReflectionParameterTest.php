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

use N86io\Reflection\ReflectionParameter;
use N86io\Reflection\Tests\Stuff\TestClass;

/**
 * Class ReflectionParameterTest
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionParameterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \ReflectionParameter
     */
    protected $methodParamOrig;

    /**
     * @var ReflectionParameter
     */
    protected $methodParam;

    /**
     * @var \ReflectionParameter
     */
    protected $funcParamOrig;

    /**
     * @var ReflectionParameter
     */
    protected $funcParam;

    public function setUp()
    {
        require realpath(__DIR__ . '/Stuff/TestFunctions.php');
        $this->methodParamOrig = new \ReflectionParameter([TestClass::class, 'method'], 'parameter');
        $this->methodParam = new ReflectionParameter([TestClass::class, 'method'], 'parameter');
        $this->funcParamOrig = new \ReflectionParameter('N86io\Reflection\Tests\Stuff\functionTest', 'funcParam');
        $this->funcParam = new ReflectionParameter('N86io\Reflection\Tests\Stuff\functionTest', 'funcParam');
    }

    public function testGetDeclaringClass()
    {
        $this->assertEquals(
            $this->methodParamOrig->getDeclaringClass()->getName(),
            $this->methodParam->getDeclaringClass()->getName()
        );
    }

    public function testGetClass()
    {
        $this->assertEquals(
            $this->methodParamOrig->getClass()->getName(),
            $this->methodParam->getClass()->getName()
        );
    }

    public function testGetDeclaringFunction()
    {
        $this->assertEquals(
            $this->methodParamOrig->getDeclaringFunction()->getName(),
            $this->methodParam->getDeclaringFunction()->getName()
        );
        $this->assertEquals(
            $this->funcParamOrig->getDeclaringFunction()->getName(),
            $this->funcParam->getDeclaringFunction()->getName()
        );
    }
}
