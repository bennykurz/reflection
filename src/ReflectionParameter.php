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

namespace N86io\Reflection;

use N86io\Reflection\Utility\ReflectionClassUtility;
use N86io\Reflection\Utility\ReflectionFunctionMethodUtility;

/**
 * Wrap the build-in \ReflectionParameter. All methods, who are return a reflection object, return a wrapped reflection
 * object.
 *
 * @author Viktor Firus <v@n86.io>
 * @since  0.1.0
 */
class ReflectionParameter extends \ReflectionParameter
{
    /**
     * @return ReflectionClass
     */
    public function getDeclaringClass()
    {
        return ReflectionClassUtility::convert(parent::getDeclaringClass());
    }

    /**
     * @return ReflectionClass
     */
    public function getClass()
    {
        return ReflectionClassUtility::convert(parent::getClass());
    }

    /**
     * @return \ReflectionFunctionAbstract
     */
    public function getDeclaringFunction()
    {
        return ReflectionFunctionMethodUtility::convert(parent::getDeclaringFunction());
    }
}
