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

namespace N86io\Reflection\Tests\Unit;

use N86io\Reflection\DocComment;
use N86io\Reflection\ReflectionClass;
use N86io\Reflection\Tests\Unit\Stuff\SomeOtherClass;
use N86io\Reflection\Tests\Unit\Stuff\TestClass;
use N86io\Reflection\Tests\Unit\Stuff\TestClassInterface;
use N86io\Reflection\Tests\Unit\Stuff\TestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class ReflectionClassTest
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionClassTest extends TestCase
{
    public function test()
    {
        $reflectionOriginal = new \ReflectionClass(TestClass::class);
        $reflection = new ReflectionClass(TestClass::class);

        $this->assertEquals(
            $reflectionOriginal->getInterfaces()[TestClassInterface::class]->getName(),
            $reflection->getInterfaces()[TestClassInterface::class]->getName()
        );

        $this->assertEquals(
            $reflectionOriginal->getParentClass()->getName(),
            $reflection->getParentClass()->getName()
        );

        $this->assertEquals(
            $reflectionOriginal->getTraits()[TestTrait::class]->getName(),
            $reflection->getTraits()[TestTrait::class]->getName()
        );

        $this->assertEquals(
            $reflectionOriginal->getConstructor()->getName(),
            $reflection->getConstructor()->getName()
        );

        $this->assertEquals(
            $reflectionOriginal->getMethods()[1]->getName(),
            $reflection->getMethods()[1]->getName()
        );

        $this->assertEquals(
            $reflectionOriginal->getMethod('method')->getName(),
            $reflection->getMethod('method')->getName()
        );

        $this->assertEquals(
            $reflectionOriginal->getProperties()[0]->getName(),
            $reflection->getProperties()[0]->getName()
        );

        $this->assertEquals(
            $reflectionOriginal->getProperty('attributes')->getName(),
            $reflection->getProperty('attributes')->getName()
        );

        $this->assertEquals($reflectionOriginal->getExtension(), $reflection->getExtension());

        $this->assertTrue($reflection->getParsedDocComment() instanceof DocComment);
    }

    public function testWithEmptyClass()
    {
        $reflectionOriginal = new \ReflectionClass(SomeOtherClass::class);
        $reflection = new ReflectionClass(SomeOtherClass::class);

        $this->assertEquals($reflectionOriginal->getInterfaces(), $reflection->getInterfaces());
        $this->assertEquals($reflectionOriginal->getParentClass(), $reflection->getParentClass());
        $this->assertEquals($reflectionOriginal->getTraits(), $reflection->getTraits());
        $this->assertEquals($reflectionOriginal->getConstructor(), $reflection->getConstructor());
        $this->assertEquals($reflectionOriginal->getMethods(), $reflection->getMethods());
        $this->assertEquals($reflectionOriginal->getProperties(), $reflection->getProperties());
        $this->assertEquals($reflectionOriginal->getConstructor(), $reflection->getConstructor());
    }

    public function testGetExtension()
    {
        $reflectionDateTimeOriginal = new \ReflectionClass(\DateTime::class);
        $reflectionDateTime = new ReflectionClass(\DateTime::class);

        $this->assertEquals(
            $reflectionDateTimeOriginal->getExtension()->getName(),
            $reflectionDateTime->getExtension()->getName()
        );
    }
}
