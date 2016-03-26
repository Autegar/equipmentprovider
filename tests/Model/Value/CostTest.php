<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 24.03.16
 * Time: 15:56
 */

namespace Christianparadies\Equipment\tests\Model\Value;

use Christianparadies\Equipment\Model\Value\Cost;

class CostTest extends \PHPUnit_Framework_TestCase
{
    public function testNewCost()
    {
        $cost = new Cost(12);

        $this->assertEquals(12, $cost->getCost(), 'Cost is not 12. But 12 was expected');
    }

    public function testSetter()
    {
        $cost = new Cost(15);

        $cost->setCost(18);

        $this->assertEquals(18, $cost->getCost(),'Expected 18. But the value differs');
    }
}