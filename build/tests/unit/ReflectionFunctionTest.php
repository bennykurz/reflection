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

namespace N86io\Reflection\Tests\Unit;

use N86io\Reflection\DocComment;
use N86io\Reflection\ReflectionFunction;
use N86io\Reflection\Tests\Unit\Stuff\FunctionTest;
use PHPUnit\Framework\TestCase;

/**
 * @author Viktor Firus <v@n86.io>
 */
class ReflectionFunctionTest extends TestCase
{
    /**
     * @var \ReflectionFunction
     */
    protected $functionOrig;

    /**
     * @var ReflectionFunction
     */
    protected $function;

    /**
     * @var \ReflectionFunction
     */
    protected $closure1Orig;

    /**
     * @var ReflectionFunction
     */
    protected $closure1;

    /**
     * @var \ReflectionFunction
     */
    protected $closure2Orig;

    /**
     * @var ReflectionFunction
     */
    protected $closure2;

    /**
     * @var \ReflectionFunction
     */
    protected $functionDateOriginal;

    /**
     * @var ReflectionFunction
     */
    protected $functionDate;

    public function setUp()
    {
        require realpath(__DIR__ . '/Stuff/TestFunctions.php');
        $this->functionOrig = new \ReflectionFunction('N86io\Reflection\Tests\Unit\Stuff\functionTest');
        $this->function = new ReflectionFunction('N86io\Reflection\Tests\Unit\Stuff\functionTest');
        $this->closure1Orig = new \ReflectionFunction(\N86io\Reflection\Tests\Unit\Stuff\closureTest());
        $this->closure1 = new ReflectionFunction(\N86io\Reflection\Tests\Unit\Stuff\closureTest());
        $this->closure2Orig = new \ReflectionFunction((new FunctionTest())->closureTest());
        $this->closure2 = new ReflectionFunction((new FunctionTest())->closureTest());

        $this->functionDateOriginal = new \ReflectionFunction('date');
        $this->functionDate = new ReflectionFunction('date');
    }

    public function testGetClosureScopeClass()
    {
        $this->assertEquals(
            $this->functionOrig->getClosureScopeClass(),
            $this->function->getClosureScopeClass()
        );
        $this->assertEquals(
            $this->closure1Orig->getClosureScopeClass(),
            $this->closure1->getClosureScopeClass()
        );
        $this->assertEquals(
            $this->closure2Orig->getClosureScopeClass()->getName(),
            $this->closure2->getClosureScopeClass()->getName()
        );
    }

    public function testGetParameters()
    {
        $this->assertEquals(
            $this->functionOrig->getParameters()[0]->getName(),
            $this->function->getParameters()[0]->getName()
        );
        $this->assertEquals(
            $this->closure1Orig->getParameters()[0]->getName(),
            $this->closure1->getParameters()[0]->getName()
        );
        $this->assertEquals(
            $this->closure2Orig->getParameters()[0]->getName(),
            $this->closure2->getParameters()[0]->getName()
        );
    }

    public function testGetExtension()
    {
        $this->assertEquals(
            $this->functionDateOriginal->getExtension()->getName(),
            $this->functionDate->getExtension()->getName()
        );
    }

    public function testGetParsedDocComment()
    {
        $this->assertTrue($this->function->getParsedDocComment() instanceof DocComment);
    }
}
