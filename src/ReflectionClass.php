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

use N86io\Reflection\Utility\ReflectionClassUtility;
use N86io\Reflection\Utility\ReflectionExtensionUtility;

/**
 * Class ReflectionClass
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionClass extends \ReflectionClass
{
    /**
     * @var DocComment
     */
    protected $docComment;

    /**
     * @return ReflectionClass[]
     */
    public function getInterfaces()
    {
        return ReflectionClassUtility::getClasses(parent::getInterfaces());
    }

    /**
     * @return bool|ReflectionClass
     */
    public function getParentClass()
    {
        return ReflectionClassUtility::getClass(parent::getParentClass());
    }

    /**
     * @return ReflectionClass[]
     */
    public function getTraits()
    {
        return ReflectionClassUtility::getClasses(parent::getTraits());
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
     *
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
     *
     * @return ReflectionMethod
     */
    public function getMethod($name)
    {
        return new ReflectionMethod($this->getName(), parent::getMethod($name)->getName());
    }

    /**
     * @param int $filter
     *
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
     *
     * @return ReflectionProperty
     */
    public function getProperty($name)
    {
        return new ReflectionProperty($this->getName(), parent::getProperty($name)->getName());
    }

    /**
     * @return ReflectionExtension|null
     */
    public function getExtension()
    {
        return ReflectionExtensionUtility::getExtension(parent::getExtension());
    }

    /**
     * @return DocComment
     */
    public function getParsedDocComment()
    {
        if (!$this->docComment) {
            $this->docComment = new DocComment($this);
        }

        return $this->docComment;
    }
}
