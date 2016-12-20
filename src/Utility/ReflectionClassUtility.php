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

namespace N86io\Reflection\Utility;

use N86io\Reflection\ReflectionClass;

/**
 * Class ReflectionClassUtility
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionClassUtility
{
    /**
     * @param bool|\ReflectionClass $class
     *
     * @return bool|ReflectionClass
     */
    public static function convertClass($class)
    {
        return $class ? new ReflectionClass($class->getName()) : false;
    }

    /**
     * @param \ReflectionClass[] $classes
     *
     * @return ReflectionClass[]
     */
    public static function convertClasses($classes)
    {
        $returnClasses = [];
        foreach ($classes as $class) {
            $returnClasses[$class->getName()] = new ReflectionClass($class->getName());
        }

        return $returnClasses;
    }
}
