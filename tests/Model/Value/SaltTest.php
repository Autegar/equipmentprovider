<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 24.03.16
 * Time: 16:26
 */

namespace Christianparadies\Equipment\tests\Model\Value;


use Christianparadies\Equipment\Model\Value\Salt;

class SaltTest extends \PHPUnit_Framework_TestCase
{
    public function testNewSalt()
    {
        $salt = new Salt('MySalt');

        $this->assertEquals('MySalt', $salt->getSalt(), 'Salt was not correctly returned');
    }

    public function testSetter()
    {
        $salt = new Salt('MySalt');

        $salt->setSalt('Other');

        $this->assertEquals('Other', $salt->getSalt(), 'Salt was not correctly returned. Expected Other');
    }
}
