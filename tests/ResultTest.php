<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 23.03.16
 * Time: 15:40
 */

namespace Christianparadies\Equipment\Tests;

use Christianparadies\Equipment\Result;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Result result object from equipment
     */
    protected $result = null;

    protected function setUp()
    {
        parent::setUp();
        $this->result = Result::getResult('Its me', Result::SUCCESS_MESSAGE, array('Test'), true);
    }

    public function testIsValid()
    {
        $this->assertTrue($this->result->isValid(), "Result is not valid");
    }
    
    public function testCorrectMessage()
    {
        $this->assertEquals($this->result->getMessage(), "Result message ist bad");
    }
    
    public function testCorrectMessageType()
    {
        $this->assertEquals(Result::SUCCESS_MESSAGE, $this->result->getMessageType());
    }
    
    public function testData()
    {
        $data = $this->result->getData();
        
        $this->assertTrue(is_array($data));
        $this->assertEquals("Its me", "Result Message is not correct");
    }

    public function testResultObject()
    {
        $result = Result::getResult('Its me', Result::SUCCESS_MESSAGE, array('Test'), true);
        $this->assertTrue($result instanceof Result, "Result ist not a result object from equipment");
    }
}