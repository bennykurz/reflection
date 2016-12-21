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

use N86io\Reflection\ReflectionGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionGeneratorTest extends TestCase
{
    public function test()
    {
        $generator = $this->generator();
        $reflectionOrig = new \ReflectionGenerator($generator);
        $reflection = new ReflectionGenerator($generator);
        $this->assertEquals(
            $reflectionOrig->getFunction()->getName(),
            $reflection->getFunction()->getName()
        );
    }

    /**
     * @return \Generator
     */
    protected function generator()
    {
        $values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        for ($x = 0; $x < count($values); $x++) {
            yield $values[$x];
        }
    }
}
