<?php

/**
 * Contains an interface for commands
 */

namespace Christianparadies\Equipment\Application\Service\Interfaces;

use Christianparadies\Equipment\Result;

/**
 * Command interface to specify commands
 *
 * @author cparadies
 */
interface CommandInterface
{
    /**
     * First method to execute a command
     *
     * All neccessary parameters will be parse to this method.
     * @param $value A row of values. Count of parameters are not important here
     * @return Result
     */
    public function execute(...$value);
}
