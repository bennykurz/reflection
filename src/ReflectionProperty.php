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
 * Class ReflectionProperty
 * @package N86io\Reflection
 */
class ReflectionProperty extends \ReflectionProperty
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
     * @return DocCommentParser
     */
    public function getParsedDocComment()
    {
        if (!$this->docCommentParser) {
            $this->docCommentParser = new DocCommentParser($this);
        }
        return $this->docCommentParser;
    }

    /**
     * @return bool
     */
    public function hasGetter()
    {
        try {
            $this->getGetter();
            return true;
        } catch (\InvalidArgumentException $e) {
            return false;
        }
    }

    /**
     * @return ReflectionMethod
     */
    public function getGetter()
    {
        $type = $this->getParsedDocComment()->hasTag('var') ?
            $this->getParsedDocComment()->getTagsByName('var')[0] : '';
        $possibleGetters = ['get' . ucfirst($this->getName())];
        if ($type === 'bool' || $type === 'boolean') {
            $possibleGetters[] = 'is' . ucfirst($this->getName());
        }
        foreach ($possibleGetters as $possibleGetter) {
            try {
                $method = $this->getDeclaringClass()->getMethod($possibleGetter);
                if ($method->isPublic()) {
                    return $method;
                }
            } catch (\ReflectionException $e) {
                // Nothing to do, if method not exist
            }
        }
        throw new \InvalidArgumentException('Property "' . $this->getName() . '" has no getter.');
    }

    /**
     * @return bool
     */
    public function hasSetter()
    {
        try {
            $this->getSetter();
            return true;
        } catch (\InvalidArgumentException $e) {
            return false;
        }
    }

    /**
     * @return ReflectionMethod
     */
    public function getSetter()
    {
        $possibleSetter = 'set' . ucfirst($this->getName());
        if ($this->getDeclaringClass()->hasMethod($possibleSetter)) {
            try {
                $method = $this->getDeclaringClass()->getMethod($possibleSetter);
                if ($method->isPublic()) {
                    return $method;
                }
            } catch (\ReflectionException $e) {
                // Nothing to do, if method not exist
            }
        }
        throw new \InvalidArgumentException('Property "' . $this->getName() . '" has no setter.');
    }
}
