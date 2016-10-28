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
 * Class ReflectionClass
 * @package N86io\Reflection
 */
class ReflectionClass extends \ReflectionClass
{
    /**
     * @return ReflectionClass[]
     */
    public function getInterfaces()
    {
        $parentInterfaces = parent::getInterfaces();
        $returnInterfaces = [];
        foreach ($parentInterfaces as $parentInterface) {
            $returnInterfaces[$parentInterface->getName()] = new ReflectionClass($parentInterface->getName());
        }
        return $returnInterfaces;
    }

    /**
     * @return bool|ReflectionClass
     */
    public function getParentClass()
    {
        $parentClass = parent::getParentClass();
        return $parentClass ? new ReflectionClass($parentClass->getName()) : false;
    }

    /**
     * @return ReflectionClass[]
     */
    public function getTraits()
    {
        $parentTraits = parent::getTraits();
        $returnTraits = [];
        foreach ($parentTraits as $parentTrait) {
            $returnTraits[$parentTrait->getName()] = new ReflectionClass($parentTrait->getName());
        }
        return $returnTraits;
    }

    /**
     * @return ReflectionMethod|null
     */
    public function getConstructor()
    {
        $parentConstructor = parent::getConstructor();
        if ($parentConstructor instanceof \ReflectionMethod) {
            return new ReflectionMethod($this->getName(), $parentConstructor->getName());
        }
        return null;
    }

    /**
     * @param int $filter
     * @return ReflectionMethod[]
     */
    public function getMethods($filter = null)
    {
        $parentMethods = $filter === null ? parent::getMethods() : parent::getMethods($filter);
        $returnMethods = [];
        foreach ($parentMethods as $originalMethod) {
            $returnMethods[] = new ReflectionMethod($this->getName(), $originalMethod->getName());
        }
        return $returnMethods;
    }

    /**
     * @param string $name
     * @return ReflectionMethod
     */
    public function getMethod($name)
    {
        return new ReflectionMethod($this->getName(), parent::getMethod($name)->getName());
    }

    /**
     * @param null $filter
     * @return ReflectionProperty[]
     */
    public function getProperties($filter = null)
    {
        $parentProperties = $filter === null ? parent::getProperties() : parent::getProperties($filter);
        $returnProperties = [];
        foreach ($parentProperties as $parentProperty) {
            $returnProperties[] = new ReflectionProperty($this->getName(), $parentProperty->getName());
        }
        return $returnProperties;
    }

    /**
     * @param string $name
     * @return ReflectionProperty
     */
    public function getProperty($name)
    {
        return new ReflectionProperty($this->getName(), parent::getProperty($name)->getName());
    }
}
