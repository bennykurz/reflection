<?php
declare(strict_types=1);

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

use N86io\Reflection\ReflectionMethod;

/**
 * Class ReflectionMethodUtility
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionMethodUtility
{
    /**
     * @param \ReflectionMethod|null $method
     *
     * @return ReflectionMethod|null
     */
    public static function get($method)
    {
        if (!$method instanceof \ReflectionMethod) {
            return null;
        }

        return ReflectionMethodUtility::convert($method);
    }

    /**
     * @param \ReflectionMethod $method
     *
     * @return ReflectionMethod
     */
    public static function convert(\ReflectionMethod $method): ReflectionMethod
    {
        return new ReflectionMethod($method->getDeclaringClass()->getName(), $method->getName());
    }

    /**
     * @param \ReflectionMethod[] $methods
     *
     * @return array
     */
    public static function convertList(array $methods): array
    {
        $returnMethods = [];
        foreach ($methods as $method) {
            $returnMethods[] = static::convert($method);
        }

        return $returnMethods;
    }
}
