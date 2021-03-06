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

namespace N86io\Reflection;

use N86io\Reflection\Utility\ReflectionClassUtility;
use N86io\Reflection\Utility\ReflectionExtensionUtility;
use N86io\Reflection\Utility\ReflectionFunctionMethodUtility;
use N86io\Reflection\Utility\ReflectionPropertyUtility;

/**
 * Wrap the build-in \ReflectionClass and extend it with doc-comment parser. All methods, who are return a reflection
 * object, return also a wrapped reflection object.
 *
 * @author Viktor Firus <v@n86.io>
 * @since  0.1.0
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
        return ReflectionClassUtility::convertList(parent::getInterfaces());
    }

    /**
     * @return bool|ReflectionClass
     */
    public function getParentClass()
    {
        return ReflectionClassUtility::get(parent::getParentClass());
    }

    /**
     * @return ReflectionClass[]
     */
    public function getTraits()
    {
        return ReflectionClassUtility::convertList(parent::getTraits());
    }

    /**
     * @return ReflectionMethod|null
     */
    public function getConstructor()
    {
        return ReflectionFunctionMethodUtility::get(parent::getConstructor());
    }

    /**
     * @param int $filter
     *
     * @return ReflectionMethod[]
     */
    public function getMethods($filter = null)
    {
        return ReflectionFunctionMethodUtility::convertList(
            $filter === null ? parent::getMethods() : parent::getMethods($filter)
        );
    }

    /**
     * @param string $name
     *
     * @return ReflectionMethod
     */
    public function getMethod($name)
    {
        return ReflectionFunctionMethodUtility::convert(parent::getMethod($name));
    }

    /**
     * @param int $filter
     *
     * @return ReflectionProperty[]
     */
    public function getProperties($filter = null)
    {
        return ReflectionPropertyUtility::convertList(
            $filter === null ? parent::getProperties() : parent::getProperties($filter)
        );
    }

    /**
     * @param string $name
     *
     * @return ReflectionProperty
     */
    public function getProperty($name)
    {
        return ReflectionPropertyUtility::convert(parent::getProperty($name));
    }

    /**
     * @return ReflectionExtension|null
     */
    public function getExtension()
    {
        return ReflectionExtensionUtility::get(parent::getExtension());
    }

    /**
     * Return the parsed doc-comment.
     *
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
