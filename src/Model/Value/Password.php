<?php

/**
 * Includes a object value for password
 */

namespace Christianparadies\Equipment\Model\Value;

/**
 * Represents a value object for a password
 *
 * @author cparadies
 */
class Password
{
    /**
     * @var string
     */
    protected $password;
    
    /**
     * initialize the password value object
     *
     * @param type $password
     */
    public function __construct($password)
    {
        $this->password = $password;
    }
    
    /**
     * Get the password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the password
     *
     * @param string $password
     * @return \Equipment\Model\Value\Password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}
