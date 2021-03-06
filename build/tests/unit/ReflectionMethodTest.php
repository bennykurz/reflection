<?php declare(strict_types = 1);
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
use N86io\Reflection\ReflectionMethod;
use N86io\Reflection\Tests\Unit\Stuff\TestClass;
use PHPUnit\Framework\TestCase;

/**
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionMethodTest extends TestCase
{
    /**
     * @var \ReflectionMethod
     */
    protected $reflectionMethodOrig;
    /**
     * @var ReflectionMethod
     */
    protected $reflectionMethod;

    /**
     * @var \ReflectionMethod
     */
    protected $methodDateTimeOriginal;

    /**
     * @var ReflectionMethod
     */
    protected $methodDateTime;

    public function setUp()
    {
        $this->reflectionMethodOrig = new \ReflectionMethod(TestClass::class, 'method');
        $this->reflectionMethod = new ReflectionMethod(TestClass::class, 'method');

        $this->methodDateTimeOriginal = new \ReflectionMethod(\DateTime::class, 'add');
        $this->methodDateTime = new ReflectionMethod(\DateTime::class, 'add');
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

    public function testGetExtension()
    {
        $this->assertEquals(
            $this->methodDateTimeOriginal->getExtension()->getName(),
            $this->methodDateTime->getExtension()->getName()
        );
    }

    public function testGetParsedDocComment()
    {
        $this->assertTrue($this->reflectionMethod->getParsedDocComment() instanceof DocComment);
    }
}
