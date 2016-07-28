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

    /**
     * Set up the result object
     */
    protected function setUp()
    {
        parent::setUp();
        $this->result = Result::getResult('Its me', Result::SUCCESS_MESSAGE, array('Test'), true);
    }

    public function testIsValid()
    {
        $this->assertTrue($this->result->isValid(), 'Result is not valid');
    }
    
    public function testCorrectMessage()
    {
        $this->assertEquals('Its me', $this->result->getMessage(), 'Result message ist bad');
    }
    
    public function testCorrectMessageType()
    {
        $this->assertEquals(1, Result::SUCCESS_MESSAGE, $this->result->getMessageType());
    }
    
    public function testData()
    {
        $data = $this->result->getData();
        
        $this->assertTrue(is_array($data));
        $this->assertEquals('Test', $data[0], 'Result Message is not correct');
    }

    public function testResultObject()
    {
        $result = Result::getResult('Its me', Result::SUCCESS_MESSAGE, array('Test'), true);
        $this->assertTrue($result instanceof Result, 'Result ist not a result object from equipment');
    }

    public function testValidJson()
    {
        $result = Result::getResult('Its me', Result::SUCCESS_MESSAGE, array('Test'), true);
        $jsonCode = $result->toJson();

        $this->assertNotNull($jsonCode, 'Json code should not be null');
    }

    public function testArray()
    {
        $result = Result::getResult('Its me', Result::SUCCESS_MESSAGE, array('Test'), true);

        $resultArray = $result->toArray();

        $this->assertTrue(is_array($resultArray), 'Result is no array');
        $this->assertEquals('Its me', $resultArray['result']['message'], 'Bad message returned');
        $this->assertEquals(Result::SUCCESS_MESSAGE, $resultArray['result']['messageType'], 'Bad messageType returned');
    }
}