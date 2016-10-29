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
 * Class ReflectionFunction
 * @package N86io\Reflection
 */
class ReflectionFunction extends \ReflectionFunction
{
    /**
     * @var DocCommentParser
     */
    protected $docCommentParser;

    /**
     * @return null|ReflectionClass
     */
    public function getClosureScopeClass()
    {
        $parentClosureScope = parent::getClosureScopeClass();
        return $parentClosureScope ? new ReflectionClass($parentClosureScope->getName()) : $parentClosureScope;
    }

    /**
     * @return ReflectionParameter[]
     */
    public function getParameters()
    {
        $parentParameters = parent::getParameters();
        $returnParameters = [];
        foreach ($parentParameters as $parentParameter) {
            if (strpos($this->getName(), '{closure}') !== false) {
                $returnParameters[] = new ReflectionParameter($this->getClosure(), $parentParameter->getName());
                continue;
            }
            $returnParameters[] = new ReflectionParameter($this->getName(), $parentParameter->getName());
        }
        return $returnParameters;
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
}
