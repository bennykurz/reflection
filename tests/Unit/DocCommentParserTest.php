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

namespace N86io\Reflection\Tests;

use N86io\Reflection\DocCommentParser;
use N86io\Reflection\ReflectionClass;
use N86io\Reflection\Tests\Stuff\AbstractTestClass;

/**
 * Class DocCommentParserTest
 * @package N86io\Reflection\Tests
 */
class DocCommentParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DocCommentParser
     */
    protected $docCommentParser;

    public function setUp()
    {
        $this->docCommentParser = new DocCommentParser(new ReflectionClass(AbstractTestClass::class));
    }

    public function testGetSummary()
    {
        $this->assertEquals('Class AbstractTestClass', $this->docCommentParser->getSummary());
    }

    public function testGetDescription()
    {
        $this->assertEquals('Description', $this->docCommentParser->getDescription());
    }

    public function testGetTags()
    {
        $this->assertEquals('N86io\Reflection\Tests', $this->docCommentParser->getTags()['package'][0]);
    }

    public function testGetTagsByName()
    {
        $this->assertEquals('N86io\Reflection\Tests', $this->docCommentParser->getTagsByName('package')[0]);
    }

    public function testGetTagsByNameException()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        $this->docCommentParser->getTagsByName('invalidTagName');
    }

    public function hasTag()
    {
        $this->assertTrue($this->docCommentParser->hasTag('package'));
        $this->assertFalse($this->docCommentParser->hasTag('invalidTagName'));
    }
}
