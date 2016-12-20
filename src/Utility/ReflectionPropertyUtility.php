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

use N86io\Reflection\ReflectionProperty;
use Webmozart\Assert\Assert;

/**
 * Class ReflectionPropertyUtility
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionPropertyUtility
{
    /**
     * @param string              $className
     * @param \ReflectionProperty $property
     *
     * @return ReflectionProperty
     */
    public static function convertProperty(string $className, \ReflectionProperty $property)
    {
        return new ReflectionProperty($className, $property->getName());
    }

    /**
     * @param string                $className
     * @param \ReflectionProperty[] $properties
     *
     * @return array|ReflectionProperty[]
     */
    public static function convertProperties(string $className, array $properties): array
    {
        $returnProperties = [];
        foreach ($properties as $property) {
            Assert::isInstanceOf($property, \ReflectionProperty::class);
            $returnProperties[] = static::convertProperty($className, $property);
        }

        return $returnProperties;
    }
}