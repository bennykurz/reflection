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

use N86io\Reflection\ReflectionParameter;
use Webmozart\Assert\Assert;

/**
 * Class ReflectionParameterUtility
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionParameterUtility
{
    /**
     * @param \Closure             $closure
     * @param \ReflectionParameter $parameter
     *
     * @return ReflectionParameter
     */
    public static function convertClosureParameter(
        \Closure $closure,
        \ReflectionParameter $parameter
    ): ReflectionParameter {
        return self::convertParameter($closure, $parameter);
    }

    /**
     * @param string               $functionName
     * @param \ReflectionParameter $parameter
     *
     * @return ReflectionParameter
     */
    public static function convertFunctionParameter(
        string $functionName,
        \ReflectionParameter $parameter
    ): ReflectionParameter {
        return self::convertParameter($functionName, $parameter);
    }

    public static function convertMethodParameter(
        string $className,
        string $methodName,
        \ReflectionParameter $parameter
    ): ReflectionParameter {
        return self::convertParameter([$className, $methodName], $parameter);
    }

    /**
     * @param string                 $functionName
     * @param \Closure               $closure
     * @param \ReflectionParameter[] $parameters
     *
     * @return ReflectionParameter[]
     */
    public static function convertFunctionParameters(string $functionName, \Closure $closure, array $parameters): array
    {
        $returnParameters = [];
        foreach ($parameters as $parameter) {
            Assert::isInstanceOf($parameter, \ReflectionParameter::class);
            if (strpos($functionName, '{closure}') !== false) {
                $returnParameters[] = static::convertClosureParameter($closure, $parameter);
                continue;
            }
            $returnParameters[] = static::convertFunctionParameter($functionName, $parameter);
        }

        return $returnParameters;
    }

    /**
     * @param string                 $className
     * @param string                 $methodName
     * @param \ReflectionParameter[] $parameters
     *
     * @return ReflectionParameter[]
     */
    public static function convertMethodParameters(string $className, string $methodName, array $parameters): array
    {
        $returnParameters = [];
        foreach ($parameters as $parameter) {
            Assert::isInstanceOf($parameter, \ReflectionParameter::class);
            $returnParameters[] = static::convertMethodParameter($className, $methodName, $parameter);
        }

        return $returnParameters;
    }

    /**
     * @param mixed                $function
     * @param \ReflectionParameter $parameter
     *
     * @return ReflectionParameter
     */
    private static function convertParameter($function, \ReflectionParameter $parameter): ReflectionParameter
    {
        return new ReflectionParameter($function, $parameter->getName());
    }
}
