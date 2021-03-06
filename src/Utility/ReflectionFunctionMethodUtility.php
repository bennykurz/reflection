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

use N86io\Reflection\ReflectionFunction;
use N86io\Reflection\ReflectionMethod;
use Webmozart\Assert\Assert;

/**
 * Collection of functions to convert build-in \ReflectionFunctionAbstract to \N86io\Reflection\ReflectionFunction or
 * \N86io\Reflection\ReflectionMethod.
 *
 * @author Viktor Firus <v@n86.io>
 * @since  1.0.0
 */
class ReflectionFunctionMethodUtility
{
    /**
     * Check if parameter is of type \ReflectionFunctionAbstract, and call and return in that case
     * self::convert($class), otherwise returns null.
     *
     * @param \ReflectionFunctionAbstract|null $method
     *
     * @return ReflectionFunction|ReflectionMethod|null
     */
    public static function get($method)
    {
        if (!$method instanceof \ReflectionFunctionAbstract) {
            return null;
        }

        return self::convert($method);
    }

    /**
     * Convert \ReflectionFunctionAbstract to \N86io\Reflection\ReflectionFunction or
     * \N86io\Reflection\ReflectionMethod.
     *
     * @param \ReflectionFunctionAbstract $function
     *
     * @return ReflectionFunction|ReflectionMethod
     */
    public static function convert(\ReflectionFunctionAbstract $function)
    {
        if ($function instanceof \ReflectionMethod) {
            return self::convertMethod($function);
        }

        /** @var \ReflectionFunction $function */
        return self::convertFunction($function);
    }

    /**
     * Convert array of objects with type \ReflectionFunctionAbstract to \N86io\Reflection\ReflectionFunction or
     * \N86io\Reflection\ReflectionMethod.
     *
     * @param \ReflectionFunctionAbstract[] $methods
     *
     * @return ReflectionFunction[]|ReflectionMethod[]
     */
    public static function convertList(array $methods): array
    {
        $returnMethods = [];
        foreach ($methods as $method) {
            Assert::isInstanceOf($method, \ReflectionFunctionAbstract::class);
            $returnMethods[] = self::convert($method);
        }

        return $returnMethods;
    }

    /**
     * Check if given parameter is closure.
     *
     * @param \ReflectionFunctionAbstract $functionAbstract
     *
     * @return bool
     */
    public static function isClosure(\ReflectionFunctionAbstract $functionAbstract): bool
    {
        return strpos($functionAbstract->getName(), '{closure}') !== false;
    }

    /**
     * Check if given parameter is function. It's doesn't count as function, if it is closure.
     *
     * @param \ReflectionFunctionAbstract $functionAbstract
     *
     * @return bool
     */
    public static function isFunction(\ReflectionFunctionAbstract $functionAbstract): bool
    {
        return (
            $functionAbstract instanceof \ReflectionFunction &&
            !self::isClosure($functionAbstract)
        );
    }

    /**
     * Check if given parameter is method. It's doesn't count as function, if it is closure.
     *
     * @param \ReflectionFunctionAbstract $functionAbstract
     *
     * @return bool
     */
    public static function isMethod(\ReflectionFunctionAbstract $functionAbstract): bool
    {
        return (
            $functionAbstract instanceof \ReflectionMethod &&
            !self::isClosure($functionAbstract)
        );
    }

    /**
     * Convert \ReflectionMethod to \N86io\Reflection\ReflectionMethod.
     *
     * @param \ReflectionMethod $method
     *
     * @return ReflectionMethod
     */
    private static function convertMethod(\ReflectionMethod $method): ReflectionMethod
    {
        return new ReflectionMethod($method->getDeclaringClass()->getName(), $method->getName());
    }

    /**
     * Convert \ReflectionFunction to \N86io\Reflection\ReflectionFunction.
     *
     * @param \ReflectionFunction $function
     *
     * @return ReflectionFunction
     */
    private static function convertFunction(\ReflectionFunction $function): ReflectionFunction
    {
        if (self::isClosure($function)) {
            return new ReflectionFunction($function->getClosure());
        }

        return new ReflectionFunction($function->getName());
    }
}
