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

use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\Types\ContextFactory;

/**
 * Class DocCommentParser
 * @package N86io\Reflection
 */
class DocCommentParser
{
    /**
     * @var string
     */
    protected $summary;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $tags;

    /**
     * DocCommentParser constructor.
     * @param \Reflector $reflector
     */
    public function __construct(\Reflector $reflector)
    {
        $contextFactory = new ContextFactory;
        $context = $contextFactory->createFromReflector($reflector);
        $docBlock = DocBlockFactory::createInstance()->create($reflector, $context);
        $this->summary = $docBlock->getSummary();
        $this->description = $docBlock->getDescription()->render();
        $tags = $docBlock->getTags();
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $name = $tag->getName();
            $rendered = $tag->render();
            $value = trim(substr($rendered, strlen($name) + 2));
            if (substr($value, -1) === '$') {
                $value = trim(substr($value, 0, strlen($value) - 2));
            }
            $this->tags[$name][] = $value ?: '';
        }
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $name
     * @return array
     */
    public function getTagsByName($name)
    {
        if (!array_key_exists($name, $this->tags)) {
            throw new \InvalidArgumentException('Tag with name "" doesn\'t exists.');
        }
        return $this->tags[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasTag($name)
    {
        return array_key_exists($name, $this->tags);
    }
}
