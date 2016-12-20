<?php
declare(strict_types=1);

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

namespace N86io\Reflection\Tests\Unit;

use N86io\Reflection\DocComment;
use N86io\Reflection\ReflectionClass;
use N86io\Reflection\ReflectionMethod;
use N86io\Reflection\Tests\Unit\Stuff\AbstractTestClass;
use N86io\Reflection\Tests\Unit\Stuff\TestClass;
use PHPUnit\Framework\TestCase;

/**
 * Class DocCommentTest
 *
 * @author Viktor Firus <v@n86.io>
 */
class DocCommentTest extends TestCase
{
    /**
     * @var DocComment
     */
    protected $docComment1;

    /**
     * @var DocComment
     */
    protected $docComment2;

    public function setUp()
    {
        $this->docComment1 = new DocComment(new ReflectionClass(AbstractTestClass::class));
        $this->docComment2 = new DocComment(new ReflectionMethod(TestClass::class, 'isBoolValue'));
    }

    public function testGetSummary()
    {
        $this->assertEquals('Class AbstractTestClass', $this->docComment1->getSummary());
        $this->assertEquals('', $this->docComment2->getSummary());
    }

    public function testGetDescription()
    {
        $this->assertEquals('Description', $this->docComment1->getDescription());
        $this->assertEquals('', $this->docComment2->getDescription());
    }

    public function testGetTags()
    {
        $this->assertEquals('Viktor Firus<v@n86.io>', $this->docComment1->getTags()['author'][0]);
    }

    public function testGetTagsByName()
    {
        $this->assertEquals('Viktor Firus<v@n86.io>', $this->docComment1->getTagsByName('author')[0]);
    }

    public function testGetTagsByNameException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->docComment1->getTagsByName('invalidTagName');
    }

    public function hasTag()
    {
        $this->assertTrue($this->docComment1->hasTag('package'));
        $this->assertFalse($this->docComment1->hasTag('invalidTagName'));
    }
}
