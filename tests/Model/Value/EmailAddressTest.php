<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 24.03.16
 * Time: 16:04
 */

namespace Christianparadies\Equipment\tests\Model\Value;


use Christianparadies\Equipment\Model\Value\EmailAddress;

class EmailAddressTest extends \PHPUnit_Framework_TestCase
{
    public function testNewEmailAddress()
    {
        $email = new EmailAddress("testmail@bitboom.de");

        $this->assertEquals('testmail@bitboom.de', $email->getEmail(), 'Expected email testmail@bitboom.de was not returned');
    }

    public function testEmailValidation()
    {
        $email = new EmailAddress('bammbi@dose');

        $this->assertEquals('No valid email', $email->getEmail(), 'This email bammbi@dose should not be a right email. But validation not failed');
    }

    public function testSetter()
    {
        $email = new EmailAddress('bammbi@dose');

        $email->setEmail('testmail@bitboom.de');

        $this->assertEquals('testmail@bitboom.de', $email->getEmail(), 'Email was not correct set. Check the setter');
    }
}
