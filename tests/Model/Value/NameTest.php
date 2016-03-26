<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 24.03.16
 * Time: 16:14
 */

namespace Christianparadies\Equipment\tests\Model\Value;


use Christianparadies\Equipment\Model\Value\Name;

class NameTest extends \PHPUnit_Framework_TestCase
{
    public function testNewName()
    {
        $name = new Name('Christian', 'Paradies');

        $this->assertEquals('Christian Paradies', $name->getFullName(), 'Full name was not correct returned. Christian Paradies was expected');
        $this->assertEquals('Christian', $name->getName(), 'Christian was expected');
        $this->assertEquals('Paradies', $name->getSurname(), 'Paradies was expected');
    }

    public function testOnlyFirstName()
    {
        $name = new Name('Christian');

        $this->assertEquals('Christian', $name->getFullName(), 'Full name should be Christian. Nothing more');
        $this->assertEquals('Christian', $name->getName(), 'Name should be Christan');
        $this->assertEquals('', $name->getSurname(), 'Surname should be empty');
    }

    public function testSetter()
    {
        $name = new Name('Christian Paradies');
        $name->setName('Olaf');
        $name->setSurname('Bartels');

        $this->assertEquals('Olaf Bartels', $name->getFullName(), 'Full name was not correct returned. Olaf Bartels was expected');
        $this->assertEquals('Olaf', $name->getName(), 'Olaf was expected');
        $this->assertEquals('Bartels', $name->getSurname(), 'Bartels was expected');
    }
}
