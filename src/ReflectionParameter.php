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

namespace N86io\Reflection;

/**
 * Class ReflectionParameter
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionParameter extends \ReflectionParameter
{
    /**
     * @return ReflectionClass
     */
    public function getDeclaringClass()
    {
        return new ReflectionClass(parent::getDeclaringClass()->getName());
    }

    /**
     * @return ReflectionClass
     */
    public function getClass()
    {
        return new ReflectionClass(parent::getClass()->getName());
    }

    /**
     * @return \ReflectionFunctionAbstract
     */
    public function getDeclaringFunction()
    {
        $parentDeclaringFunction = parent::getDeclaringFunction();
        if ($parentDeclaringFunction instanceof \ReflectionMethod) {
            return new ReflectionMethod($this->getDeclaringClass()->getName(), $parentDeclaringFunction->getName());
        }

        return new ReflectionFunction($parentDeclaringFunction->getName());
    }
}
