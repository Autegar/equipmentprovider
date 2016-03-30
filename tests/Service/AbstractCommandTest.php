<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 23.03.16
 * Time: 16:42
 */

namespace Christianparadies\Equipment\Tests\Service;

use Christianparadies\Equipment\Exception\EquipmentException;
use Christianparadies\Equipment\Exception\InvalidNumberOfArgumentsException;
use Christianparadies\Equipment\Exception\InvalidArgumentException;
use Christianparadies\Equipment\Service\AbstractCommand;
use Christianparadies\Equipment\Service\Interfaces\CommandInterface;
use PHPUnit_Framework_TestCase;

class AbstractCommandTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractCommand
     */
    protected $stubAbstractCommand = null;

    public function setUp()
    {
        parent::setUp();
        $this->stubAbstractCommand = $this->getMockForAbstractClass('Christianparadies\Equipment\Service\AbstractCommand');
    }

    public function testStub()
    {
        $isCommandInterface = $this->stubAbstractCommand instanceof CommandInterface;
        $this->assertTrue($isCommandInterface, "AbstractCommand has to implements command interface");
    }

    public function testValidation()
    {
        $integerType = "integer";
        $stringType  = "string";
        $doubleType  = "double";
        $mixedType   = "mixed";
        $phpunit     = $this;

        $isValidInteger = $this->stubAbstractCommand->validate(10, $integerType);
        $this->assertTrue($isValidInteger, "Integer type could not be validated");

        $isValidString = $this->stubAbstractCommand->validate("Beagle", $stringType);
        $this->assertTrue($isValidString, "String type could not validated");

        $isValidPhpunit = $this->stubAbstractCommand->validate($phpunit, "PHPUnit_Framework_TestCase");
        $this->assertTrue($isValidPhpunit, "PHPUnit could not validate this class PHPUnit_Framework_TestCase");

        $isNoValidInteger = $this->stubAbstractCommand->validate(10.43, $integerType);
        $this->assertFalse($isNoValidInteger, "Float was accapted as integer. Thats wrong");

        $isNoValidDouble = $this->stubAbstractCommand->validate(14, $doubleType);
        $this->assertFalse($isNoValidDouble, "This value was validate as double. But its an integer");

        $isValidMixed    = $this->stubAbstractCommand->validate("Mein Hollywood Film", $mixedType);
        $this->assertTrue($isValidMixed, "This type has to be valid. Its mixed. All is valid");

        $isValidMixed    = $this->stubAbstractCommand->validate($phpunit, $mixedType);
        $this->assertTrue($isValidMixed, "This class has to be valid. Its mixed. All is valid");
    }

    public function testArrayValidation()
    {
        $parameters     = ['My String', 99, $this, 3.20, 'Absoulte false'];
        $goodTypes      = ['String', 'Integer', 'PHPUnit_Framework_TestCase', 'Float', 'mixed'];
        $exceptionTypes = ['String', 'Integer', 'PHPUnit_Framework_TestCase', 'mixed'];
        $badTypes       = ['String', 'Float', 'PHPUnit_Framework_TestCase', 'Float', 'integer'];

        $isValid        = $this->stubAbstractCommand->validateArrayParams($parameters, $goodTypes);
        $this->assertTrue($isValid, 'Not all parameters are correct. Errorlist : ' . print_r($isValid, true));

        $errorArray     = $this->stubAbstractCommand->validateArrayParams($parameters, $badTypes);
        $this->assertTrue(is_array($errorArray), 'Error array was not returned after array validation');

        if (is_array($errorArray)) {
            $this->assertEquals(2, count($errorArray), '2 Errors are expected. But only ' . count($errorArray) . ' was reported');
        }

        $this->setExpectedException(EquipmentException::class, 'Could not validate params as array because array count from params and paramtypes differs');
        $this->stubAbstractCommand->validateArrayParams($parameters, $exceptionTypes);

    }
    
    public function testCheckNumberOfParameters()
    {
        $this->setExpectedException(InvalidNumberOfArgumentsException::class, 'This command expect at least 3 parameters. 4 given!');
        $this->stubAbstractCommand->checkNumberOfArguments(4, 3);
    }
    
    public function testCheckParameters()
    {
        $params = ['tester', 10.00];
        $types  = ['integer', 'float'];
        
        $this->setExpectedException(InvalidArgumentException::class, 'Parameters are not valid.');
        $this->stubAbstractCommand->checkParameters($params, $types);
    }
}
