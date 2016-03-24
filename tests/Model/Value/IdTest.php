<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 24.03.16
 * Time: 16:12
 */

namespace Christianparadies\Equipment\tests\Model\Value;


use Christianparadies\Equipment\Model\Value\Id;

class IdTest extends \PHPUnit_Framework_TestCase
{
    public function testNewId()
    {
        $id = new Id('12345');

        $this->assertEquals('12345', $id->getId(), 'Expected id 12345 was not returned');
    }

    public function testSetter()
    {
        $id = new Id('12345');

        $id->setId('1122');

        $this->assertEquals('1122', $id->getId(), 'Expected id 1122 was not returned');
    }
}
