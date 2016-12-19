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
 * Class ReflectionExtension
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionExtension extends \ReflectionExtension
{
    /**
     * @return ReflectionClass[]
     */
    public function getClasses()
    {
        $parentClasses = parent::getClasses();
        $returnClasses = [];
        foreach ($parentClasses as $parentClass) {
            $returnClasses[] = new ReflectionClass($parentClass->getName());
        }

        return $returnClasses;
    }
}
