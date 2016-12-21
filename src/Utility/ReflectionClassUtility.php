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

namespace N86io\Reflection\Utility;

use N86io\Reflection\ReflectionClass;
use Webmozart\Assert\Assert;

/**
 * Collection of functions to convert build-in \ReflectionClass to \N86io\Reflection\ReflectionClass.
 *
 * @author Viktor Firus <v@n86.io>
 * @since  1.0.0
 */
class ReflectionClassUtility
{
    /**
     * Check if parameter is of type \ReflectionClass, and call and return in that case self::convert($class),
     * otherwise returns the given value again.
     *
     * @param bool|\ReflectionClass $class
     *
     * @return bool|ReflectionClass|null
     */
    public static function get($class)
    {
        if (!$class instanceof \ReflectionClass) {
            return $class;
        }

        return static::convert($class);
    }

    /**
     * Convert \ReflectionClass to \N86io\Reflection\ReflectionClass.
     *
     * @param \ReflectionClass $class
     *
     * @return ReflectionClass
     */
    public static function convert(\ReflectionClass $class): ReflectionClass
    {
        return new ReflectionClass($class->getName());
    }

    /**
     * Convert array of objects with type \ReflectionClass to \N86io\Reflection\ReflectionClass.
     *
     * @param \ReflectionClass[] $classes
     *
     * @return ReflectionClass[]
     */
    public static function convertList(array $classes): array
    {
        $returnClasses = [];
        foreach ($classes as $class) {
            Assert::isInstanceOf($class, \ReflectionClass::class);
            $returnClasses[$class->getName()] = static::convert($class);
        }

        return $returnClasses;
    }
}
