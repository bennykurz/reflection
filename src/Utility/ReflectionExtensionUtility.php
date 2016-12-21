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

use N86io\Reflection\ReflectionExtension;

/**
 * Collection of functions to convert build-in \ReflectionExtension to \N86io\Reflection\ReflectionExtension.
 *
 * @author Viktor Firus <v@n86.io>
 * @since  1.0.0
 */
class ReflectionExtensionUtility
{
    /**
     * Check if parameter is of type \ReflectionExtension, and call and return in that case self::convert($class),
     * otherwise returns null.
     *
     * @param \ReflectionExtension|null $extension
     *
     * @return ReflectionExtension|null
     */
    public static function get($extension)
    {
        if (!$extension instanceof \ReflectionExtension) {
            return null;
        }

        return static::convert($extension);
    }

    /**
     * Convert \ReflectionExtension to \N86io\Reflection\ReflectionExtension.
     *
     * @param \ReflectionExtension $extension
     *
     * @return ReflectionExtension
     */
    public static function convert(\ReflectionExtension $extension)
    {
        return new ReflectionExtension($extension->getName());
    }
}
