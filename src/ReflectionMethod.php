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
 * Class ReflectionMethod
 * @package N86io\Reflection
 */
class ReflectionMethod extends \ReflectionMethod
{
    /**
     * @var DocCommentParser
     */
    protected $docCommentParser;

    /**
     * @return ReflectionClass
     */
    public function getDeclaringClass()
    {
        return new ReflectionClass(parent::getDeclaringClass()->getName());
    }

    /**
     * @return bool|ReflectionClass
     */
    public function getClosureScopeClass()
    {
        $parentClosureScope = parent::getClosureScopeClass();
        return $parentClosureScope ? new ReflectionClass($parentClosureScope->getName()) : false;
    }

    /**
     * @return ReflectionParameter[]
     */
    public function getParameters()
    {
        $parentParameters = parent::getParameters();
        $returnParameters = [];
        foreach ($parentParameters as $parentParameter) {
            $returnParameters[] = new ReflectionParameter(
                [$this->getDeclaringClass()->getName(), $this->getName()],
                $parentParameter->getName()
            );
        }
        return $returnParameters;
    }

    /**
     * @return ReflectionMethod
     */
    public function getPrototype()
    {
        $parentPrototype = parent::getPrototype();
        return new ReflectionMethod($this->getDeclaringClass()->getName(), $parentPrototype->getName());
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->getParsedDocComment()->getTags();
    }

    /**
     * @param string $name
     * @return array
     */
    public function getTagsByName($name)
    {
        return $this->getParsedDocComment()->getTagsByName($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasTag($name)
    {
        return $this->getParsedDocComment()->hasTag($name);
    }

    /**
     * @return DocCommentParser
     */
    protected function getParsedDocComment()
    {
        if (!$this->docCommentParser) {
            $this->docCommentParser = new DocCommentParser($this);
        }
        return $this->docCommentParser;
    }
}
