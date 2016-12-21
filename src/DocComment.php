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

use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\Types\ContextFactory;
use Webmozart\Assert\Assert;

/**
 * In this class the doc-comment parser from phpDocumentor\Reflection will be used to parse doc-comment and provide the
 * summary, description and tags.
 *
 * @author Viktor Firus <v@n86.io>
 * @since  0.1.0
 */
class DocComment
{
    /**
     * Summary of doc-comment. (First, short description.)
     *
     * @var string
     */
    private $summary = '';

    /**
     * Description of doc-comment. (Second long description.)
     *
     * @var string
     */
    private $description = '';

    /**
     * Tags used in doc-comment.
     *
     * @var array
     */
    private $tags = [];

    /**
     * Parse the doc-comment and store it to the given class-variables.
     *
     * @param \Reflector $reflector
     */
    public function __construct(\Reflector $reflector)
    {
        Assert::methodExists($reflector, 'getDocComment');

        $contextFactory = new ContextFactory;
        $context = $contextFactory->createFromReflector($reflector);

        if (($docCommentString = $reflector->getDocComment()) === false) {
            return;
        }

        $docBlock = DocBlockFactory::createInstance()->create($docCommentString, $context);

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
     * Return the parsed summary.
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Return the parsed description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Return all parsed tags with values.
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Return values from tag-name. Throw exception, if tag name doesn't exist.
     *
     * @param string $name
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getTagsByName(string $name)
    {
        if (!$this->hasTag($name)) {
            throw new \InvalidArgumentException('Tag with name "' . $name . '" doesn\'t exists.');
        }

        return $this->tags[$name];
    }

    /**
     * Check if tag-name exist.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasTag(string $name)
    {
        return array_key_exists($name, $this->tags);
    }
}
