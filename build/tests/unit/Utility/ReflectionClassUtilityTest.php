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

namespace N86io\Reflection\Tests\Unit\Utility;

use N86io\Reflection\ReflectionClass;
use N86io\Reflection\Tests\Unit\Stuff\TestClass;
use N86io\Reflection\Utility\ReflectionClassUtility;
use PHPUnit\Framework\TestCase;

/**
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionClassUtilityTest extends TestCase
{
    public function testGetClass()
    {
        $reflectionOriginal = new \ReflectionClass(self::class);
        $reflection = ReflectionClassUtility::get($reflectionOriginal);
        $this->assertInstanceOf(ReflectionClass::class, $reflection);

        $reflection = ReflectionClassUtility::get(null);
        $this->assertNull($reflection);
    }

    public function testConvertClass()
    {
        $reflectionOriginal = new \ReflectionClass(self::class);
        $reflection = ReflectionClassUtility::convert($reflectionOriginal);
        $this->assertInstanceOf(ReflectionClass::class, $reflection);
        $this->assertEquals($reflectionOriginal->getName(), $reflection->getName());
    }

    public function testConvertClasses()
    {
        $classesOriginal = [
            self::class      => new \ReflectionClass(self::class),
            TestClass::class => new \ReflectionClass(TestClass::class)
        ];
        $classes = ReflectionClassUtility::convertList($classesOriginal);

        foreach ($classes as $class) {
            $this->assertInstanceOf(ReflectionClass::class, $class);
        }
    }
}
