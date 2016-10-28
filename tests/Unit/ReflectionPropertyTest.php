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

use N86io\Reflection\ReflectionProperty;
use N86io\Reflection\TestClass;

class ReflectionPropertyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \ReflectionProperty
     */
    protected $propertyOrig;

    /**
     * @var ReflectionProperty
     */
    protected $property;

    public function setUp()
    {
        $this->propertyOrig = new \ReflectionProperty(TestClass::class, 'attributes');
        $this->property = new ReflectionProperty(TestClass::class, 'attributes');
    }

    public function testGetDeclaringClass()
    {
        $this->assertEquals(
            $this->propertyOrig->getDeclaringClass()->getName(),
            $this->property->getDeclaringClass()->getName()
        );
    }
}
