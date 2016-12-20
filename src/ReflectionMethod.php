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
 * Class ReflectionMethod
 *
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionMethod extends \ReflectionMethod
{
    /**
     * @var DocComment
     */
    private $docComment;

    /**
     * @return ReflectionClass
     */
    public function getDeclaringClass()
    {
        return ReflectionClassUtility::getClass(parent::getDeclaringClass());
    }

    /**
     * @return bool|ReflectionClass
     */
    public function getClosureScopeClass()
    {
        return ReflectionClassUtility::getClass(parent::getClosureScopeClass());
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
        return ReflectionMethodUtility::convertMethod($this->getDeclaringClass()->getName(), parent::getPrototype());
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
