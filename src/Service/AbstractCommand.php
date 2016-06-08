<?php

/*
 * Christian Paradies
 * 
 * @copyright celexon Germany GmbH & Co. KG, Emsdetten
 * 
 */

namespace Christianparadies\Equipment\Service;

use Christianparadies\Equipment\Exception\EquipmentException;
use Christianparadies\Equipment\Exception\InvalidArgumentException;
use Christianparadies\Equipment\Exception\InvalidNumberOfArgumentsException;
use Christianparadies\Equipment\Service\Interfaces\CommandInterface;

/**
 * Provides a basic method to validate the params
 *
 * @author cparadies
 */
abstract class AbstractCommand implements CommandInterface
{
    /**
     * This function controls the command
     * {@inheritdoc}
     */
    abstract public function execute(...$value);

    /**
     * Its important to validate the params
     *
     * @param string $param
     * @param string $paramType
     * @param string $caller
     * @param int $lineNumber
     * @return bool
     */
    public function validate($param, $paramType, $caller = '', $lineNumber = 0)
    {
        return $this->isValid($param, $paramType);
    }

    /**
     * Validate more than one parameter at the same time.
     *
     * @param array $param
     * @param array $paramTypes
     * @param string $caller
     * @param int $linenumber
     * @return mixed
     * @throws EquipmentException
     */
    public function validateArrayParams(array $param, array $paramTypes, $caller = "", $linenumber = 0)
    {
        return $this->validateArray($param, $paramTypes, $caller, $linenumber);
    }

    /**
     * Validates the parameter against the given type.
     *
     * @param string $param
     * @param string $paramType
     * @return bool
     */
    private function isValid($param, $paramType)
    {
        $lowerCaseParamType = strtolower($paramType);
        if ($lowerCaseParamType === 'mixed') {
            return true;
        }

        if ($this->isScalarType($lowerCaseParamType)) {
            $method = 'is_' . $lowerCaseParamType;

            $isValid = $method($param);
            return $isValid;
        }

        if ($lowerCaseParamType === 'array') {
            return is_array($param);
        }

        $isValid = is_a($param, $paramType);
        return $isValid;
    }

    /**
     * Checks if the given param is a scalar type.
     *
     * This method is not the same like is_scalar. This methods checks more types.
     * @param $param
     * @return bool
     */
    private function isScalarType($param)
    {
        switch ($param) {
            case 'string':
                return true;

            case 'float':
                return true;

            case 'double':
                return true;

            case 'int':
                return true;

            case 'bool':
                return true;

            case 'integer':
                return true;

            case 'long':
                return true;

            default:
                return false;
        }
    }

    /**
     * Validate parameter given as array
     *
     * To validate pass to arrays. The first array includes the parameters itself and the seconds includes the
     * parameter types. One parameter has to match one type. Example
     *
     * parameter : [TestObject, "teststring", OtherObject]
     * parametertypes : [TestObject, "string", "mixed"]
     *
     * If TestObject not match the type TestObject return value ist an array with errors. Same for string. Mixed is
     * always true. If no errors are available return value is true.
     * @param array $params
     * @param mixed $paramTypes
     * @param string $caller
     * @param int $lineNumber
     * @return array|bool true if no error appears and array if errors are available.
     * @throws EquipmentException
     */
    private function validateArray(array $params, array $paramTypes, $caller, $lineNumber)
    {
        $valid = true;
        $objectErrors = [];

        if (count($params) !== count($paramTypes)) {
            throw new EquipmentException(
                'Could not validate params as array because array count from params and paramtypes differs'
            );
        }

        $arrayCount = count($params);

        for ($arrayIndex = 0; $arrayIndex < $arrayCount; $arrayIndex++) {
            if (!$this->isValid($params[$arrayIndex], $paramTypes[$arrayIndex])) {
                $valid = false;
                $objectErrors[] = ['param' => $params, 'type' => $paramTypes, 'caller' => $caller, 'line' => $lineNumber];
            }
        }

        if ($valid) {
            return true;
        }

        return $objectErrors;
    }
    
    /**
     * Checks the parametercount
     *
     * If parameter count is greater than 2 InvalidNumberOfArgumentsExepction will be thrown.
     * @param integer $numberOfArguments
     * @param integer $expected
     * @throws \Celexon\FileService\Exception\InvalidNumberOfArgumentsException
     */
    public function checkNumberOfArguments($numberOfArguments, $expected)
    {
        if ($numberOfArguments !== $expected) {
            throw new InvalidNumberOfArgumentsException(
                'This command expect at least ' . $expected . ' parameters. ' . $numberOfArguments . ' given!'
            );
        }
    }

    /**
     * Validate the given parameters
     *
     * If parameters or one of it is not valid, an InvalidArgumentException will be thrown. This given parameters
     * have to be a string.
     * @param array $parameters
     * @throws \Celexon\FileService\Exception\InvalidArgumentException
     * @throws \Christianparadies\Equipment\Exception\InvalidArgumentException
     */
    public function checkParameters(array $parameters, array $parameterTypes)
    {
        try {
            $result = $this->validateArrayParams($parameters, $parameterTypes);
        } catch (EquipmentException $equipmentException) {
            throw new InvalidArgumentException(
                'Parameters are marked as not valid. Reason is a leading exception',
                $equipmentException->getCode(),
                $equipmentException
            );
        }

        if (is_array($result)) {
            $reason = '';
            foreach ($result as $problem) {
                $reason .= $this->getFormattedErrorLine($problem);
            }

            throw new InvalidArgumentException(
                'Parameters are not valid. Reason : ' . $reason
            );
        }
    }

    /**
     * Format the error line for printing.
     *
     * @param array $problem
     * @return string
     */
    private function getFormattedErrorLine(array $problem)
    {
        $formattedErrorLine = '';

        $paramCount = count($problem['param']);

        for ($i = 0; $i < $paramCount; $i++) {
            $formattedErrorLine .= $problem['param'][$i] . ' => ' . $problem['type'][$i] . PHP_EOL;
        }


        return $formattedErrorLine;
    }
}
