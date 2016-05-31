<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 24.03.16
 * Time: 16:21
 */

namespace Christianparadies\Equipment\tests\Model\Value;


use Christianparadies\Equipment\Model\Value\Password;

class PasswordTest extends \PHPUnit_Framework_TestCase
{
    public function testNewPassword()
    {
        $password = new Password('Test');

        $this->assertEquals('Test', $password->getPassword(), 'Test was the expected password.');
    }

    public function testSetter()
    {
        $password = new Password('Test');

        $password->setPassword('12345');

        $this->assertEquals('12345', $password->getPassword(), 'Expected password was 12345');
    }
}
