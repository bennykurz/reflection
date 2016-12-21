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

use N86io\Reflection\ReflectionParameter;
use N86io\Reflection\Tests\Unit\Stuff\TestClass;
use N86io\Reflection\Utility\ReflectionParameterUtility;
use PHPUnit\Framework\TestCase;

/**
 * Class ReflectionParameterUtilityTest
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionParameterUtilityTest extends TestCase
{
    public function test()
    {
        require realpath(__DIR__ . '/../Stuff/TestFunctions.php');
        $closure = function (&$test) {
            $test = 1;
        };

        $parametersOrig = [
            new \ReflectionParameter([TestClass::class, 'method'], 'parameter'),
            new \ReflectionParameter('N86io\Reflection\Tests\Unit\Stuff\functionTest', 'funcParam'),
            new \ReflectionParameter($closure, 'test')
        ];
        $parameters = ReflectionParameterUtility::convertList($parametersOrig);

        $this->assertInstanceOf(ReflectionParameter::class, $parameters[0]);
        $this->assertEquals('parameter', $parameters[0]->getName());

        $this->assertInstanceOf(ReflectionParameter::class, $parameters[1]);
        $this->assertEquals('funcParam', $parameters[1]->getName());

        $this->assertInstanceOf(ReflectionParameter::class, $parameters[2]);
        $this->assertEquals('test', $parameters[2]->getName());
    }
}
