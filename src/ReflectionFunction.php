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

use N86io\Reflection\Utility\ReflectionExtensionUtility;

/**
 * Class ReflectionFunction
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionFunction extends \ReflectionFunction
{
    /**
     * @var DocComment
     */
    protected $docComment;

    /**
     * @return null|ReflectionClass
     */
    public function getClosureScopeClass()
    {
        $parentClosureScope = parent::getClosureScopeClass();

        return $parentClosureScope ? new ReflectionClass($parentClosureScope->getName()) : null;
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
