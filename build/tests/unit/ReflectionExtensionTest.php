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

use N86io\Reflection\ReflectionExtension;
use PHPUnit\Framework\TestCase;

/**
 * Class ReflectionExtensionTest
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionExtensionTest extends TestCase
{
    /**
     * @var \ReflectionExtension
     */
    protected $reflectionDateTimeOriginal;

    /**
     * @var ReflectionExtension
     */
    protected $reflectionDateTime;

    public function setUp()
    {
        $this->reflectionDateTimeOriginal = new \ReflectionExtension('date');
        $this->reflectionDateTime = new ReflectionExtension('date');
    }

    public function testGetClasses()
    {
        $classNamesOriginal = [];
        foreach ($this->reflectionDateTimeOriginal->getClasses() as $reflectionClass) {
            $classNamesOriginal[] = $reflectionClass->getName();
        }

        $classNames = [];
        foreach ($this->reflectionDateTime->getClasses() as $reflectionClass) {
            $classNames[] = $reflectionClass->getName();
        }

        $this->assertEquals($classNamesOriginal, $classNames);
    }
}
