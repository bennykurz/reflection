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

use N86io\Reflection\ReflectionFunction;
use N86io\Reflection\ReflectionMethod;
use N86io\Reflection\Utility\ReflectionFunctionMethodUtility;
use PHPUnit\Framework\TestCase;

/**
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionFunctionMethodUtilityTest extends TestCase
{
    public function testReflectionFunction()
    {
        $this->assertInstanceOf(
            ReflectionFunction::class,
            ReflectionFunctionMethodUtility::convert(new \ReflectionFunction('date'))
        );

        $closure = function () {
        };
        $this->assertInstanceOf(
            ReflectionFunction::class,
            ReflectionFunctionMethodUtility::convert(new \ReflectionFunction($closure))
        );
    }

    public function testReflectionMethod()
    {
        $reflection = ReflectionFunctionMethodUtility::get(null);
        $this->assertNull($reflection);

        $methodsOriginal = [
            new \ReflectionMethod(self::class, 'testReflectionFunction'),
            new \ReflectionMethod(self::class, 'testReflectionMethod'),
        ];
        $methods = ReflectionFunctionMethodUtility::convertList($methodsOriginal);

        foreach ($methods as $method) {
            $this->assertInstanceOf(ReflectionMethod::class, $method);
        }
        $this->assertEquals('testReflectionFunction', $methods[0]->getName());
        $this->assertEquals('testReflectionMethod', $methods[1]->getName());
    }
}
