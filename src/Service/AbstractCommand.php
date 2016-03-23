<?php

/*
 * Christian Paradies
 * 
 * @copyright celexon Germany GmbH & Co. KG, Emsdetten
 * 
 */

namespace Christianparadies\Equipment\Service;

use Christianparadies\Equipment\Application\Service\Interfaces\CommandInterface;
use Christianparadies\Equipment\Exception\EquipmentException;

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
     * @throws \Christianparadies\Equipment\Exception\EquipmentException
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
            return $method($param);
        }

        return is_a($param, $paramType);
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

            case 'boolean':
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
     * @throws \Christianparadies\Equipment\Exception\EquipmentException
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
                $objectErrors[] = [['param'] => $params, ['type'] => $paramTypes, ['caller'] => $caller, ['line'] => $lineNumber];
            }
        }

        if ($valid) {
            return true;
        }

        return $objectErrors;
    }
}
