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
namespace N86io\Reflection\Tests\Unit\Utility;

use N86io\Reflection\ReflectionMethod;
use N86io\Reflection\Utility\ReflectionMethodUtility;
use PHPUnit\Framework\TestCase;

/**
 * Class ReflectionMethodUtilityTest
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionMethodUtilityTest extends TestCase
{
    public function testGetMethod()
    {
        $reflection = ReflectionMethodUtility::getMethod(null);
        $this->assertNull($reflection);

        $reflectionOriginal = new \ReflectionMethod(self::class, 'testGetMethod');
        $reflection = ReflectionMethodUtility::getMethod($reflectionOriginal);
        $this->assertInstanceOf(ReflectionMethod::class, $reflection);
    }

    public function testConvertMethod()
    {
        $reflectionOriginal = new \ReflectionMethod(self::class, 'testConvertMethod');
        $reflection = ReflectionMethodUtility::convertMethod($reflectionOriginal);
        $this->assertInstanceOf(ReflectionMethod::class, $reflection);
        $this->assertEquals($reflectionOriginal->getName(), $reflection->getName());
    }

    public function testConvertMethods()
    {
        $methodsOriginal = [
            new \ReflectionMethod(self::class, 'testGetMethod'),
            new \ReflectionMethod(self::class, 'testConvertMethod'),
            new \ReflectionMethod(self::class, 'testConvertMethods'),
        ];
        $methods = ReflectionMethodUtility::convertMethods($methodsOriginal);

        foreach ($methods as $method) {
            $this->assertInstanceOf(ReflectionMethod::class, $method);
        }
    }
}
