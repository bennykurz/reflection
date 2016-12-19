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

namespace N86io\Reflection\Tests\Unit\Stuff;

/**
 * Class TestClass
 *
 * @author       Viktor Firus <v@n86.io>
 * @tagSomething
 * @tagSomething with value
 * @otherTag     hello
 */
class TestClass extends AbstractTestClass
{
    use TestTrait;

    const CONSTANT = 'const';

    /**
     * @var string
     */
    protected $attributes = 'attr';

    /**
     * @var array
     */
    protected $property;

    /**
     * @var boolean
     */
    protected $boolValue;

    /**
     * TestClass constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param AbstractTestClass $parameter
     *
     * @return string
     */
    public function method(AbstractTestClass $parameter)
    {
        return $parameter;
    }

    /**
     * @return string
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return array
     */
    protected function getProperty()
    {
        return $this->property;
    }

    /**
     * @param array $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    public function isBoolValue()
    {
        return $this->boolValue;
    }
}
