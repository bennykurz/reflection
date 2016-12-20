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
use N86io\Reflection\Utility\ReflectionMethodUtility;

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
    private $docComment;

    /**
     * @return ReflectionClass[]
     */
    public function getInterfaces()
    {
        return ReflectionClassUtility::convertClasses(parent::getInterfaces());
    }

    /**
     * @return bool|ReflectionClass
     */
    public function getParentClass()
    {
        return ReflectionClassUtility::convertClass(parent::getParentClass());
    }

    /**
     * @return ReflectionClass[]
     */
    public function getTraits()
    {
        return ReflectionClassUtility::convertClasses(parent::getTraits());
    }

    /**
     * @return ReflectionMethod|null
     */
    public function getConstructor()
    {
        $parentConstructor = parent::getConstructor();

        return $parentConstructor instanceof \ReflectionMethod ?
            ReflectionMethodUtility::convertMethod($this->getName(), $parentConstructor) :
            null;
    }

    /**
     * @param int $filter
     *
     * @return ReflectionMethod[]
     */
    public function getMethods($filter = null)
    {
        $parentMethods = $filter === null ? parent::getMethods() : parent::getMethods($filter);

        return ReflectionMethodUtility::convertMethods($this->getName(), $parentMethods);
    }

    /**
     * @param string $name
     *
     * @return ReflectionMethod
     */
    public function getMethod($name)
    {
        return ReflectionMethodUtility::convertMethod($this->getName(), parent::getMethod($name));
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
        return ReflectionExtensionUtility::convertExtension(parent::getExtension());
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
