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

use N86io\Reflection\ReflectionProperty;
use N86io\Reflection\Utility\ReflectionPropertyUtility;
use PHPUnit\Framework\TestCase;

/**
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionPropertyUtilityTest extends TestCase
{
    protected $testProperty1;

    protected $testProperty2;

    public function test()
    {
        $propertiesOrig = [
            new \ReflectionProperty(self::class, 'testProperty1'),
            new \ReflectionProperty(self::class, 'testProperty2')
        ];

        $properties = ReflectionPropertyUtility::convertList($propertiesOrig);

        $this->assertInstanceOf(ReflectionProperty::class, $properties[0]);
        $this->assertInstanceOf(ReflectionProperty::class, $properties[1]);
        $this->assertEquals('testProperty1', $properties[0]->getName());
        $this->assertEquals('testProperty2', $properties[1]->getName());
    }
}
