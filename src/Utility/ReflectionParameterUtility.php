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

use N86io\Reflection\Exception\ReflectionParameterException;
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
     * @param \ReflectionParameter $parameter
     *
     * @return ReflectionParameter
     */
    public static function convert(\ReflectionParameter $parameter): ReflectionParameter
    {
        $functionDefinition = self::createFunctionDefinition($parameter);

        return new ReflectionParameter($functionDefinition, $parameter->getName());
    }

    /**
     * @param \ReflectionParameter[] $parameters
     *
     * @return ReflectionParameter[]
     */
    public static function convertList(array $parameters): array
    {
        $returnParameters = [];
        foreach ($parameters as $parameter) {
            Assert::isInstanceOf($parameter, \ReflectionParameter::class);
            $returnParameters[] = static::convert($parameter);
        }

        return $returnParameters;
    }

    /**
     * @param \ReflectionParameter $parameter
     *
     * @return array|\Closure|string
     * @throws ReflectionParameterException
     */
    private static function createFunctionDefinition(\ReflectionParameter $parameter)
    {
        if (self::isClosureParameter($parameter)) {
            $func = $parameter->getDeclaringFunction();
            if ($func instanceof \ReflectionMethod) {
                return $func->getClosure($func->getClosureThis());
            }

            /** @var \ReflectionFunction $func */
            return $func->getClosure();
        }

        if (self::isFunctionParameter($parameter)) {
            return $parameter->getDeclaringFunction()->getName();
        }

        if (self::isMethodParameter($parameter)) {
            return [
                $parameter->getDeclaringClass()->getName(),
                $parameter->getDeclaringFunction()->getName()
            ];
        }

        // @codeCoverageIgnoreStart
        throw new ReflectionParameterException('Unknown error.');
        // @codeCoverageIgnoreEnd
    }

    /**
     * @param \ReflectionParameter $parameter
     *
     * @return bool
     */
    private static function isClosureParameter(\ReflectionParameter $parameter): bool
    {
        return strpos($parameter->getDeclaringFunction()->getName(), '{closure}') !== false;
    }

    /**
     * @param \ReflectionParameter $parameter
     *
     * @return bool
     */
    private static function isFunctionParameter(\ReflectionParameter $parameter): bool
    {
        return (
            $parameter->getDeclaringFunction() instanceof \ReflectionFunction &&
            !self::isClosureParameter($parameter)
        );
    }

    /**
     * @param \ReflectionParameter $parameter
     *
     * @return bool
     */
    private static function isMethodParameter(\ReflectionParameter $parameter): bool
    {
        return (
            $parameter->getDeclaringFunction() instanceof \ReflectionMethod &&
            !self::isClosureParameter($parameter)
        );
    }
}
