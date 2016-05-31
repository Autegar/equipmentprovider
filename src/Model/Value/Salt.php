<?php

/**
 * Includes a class representing a salt value object
 */
namespace Christianparadies\Equipment\Model\Value;

/**
 * This value object helps to manage the salt for crypting.
 *
 * @author cparadies
 */
class Salt
{
    /**
     * @var string salt for crypting
     */
    protected $salt;
    
    /**
     * initialize the salt value object
     *
     * @param string $salt
     */
    public function __construct($salt)
    {
        $this->salt = $salt;
    }
    
    /**
     * Get the salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set the salt for this value object
     *
     * @param string $salt
     * @return \Equipment\Model\Value\Salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }
}
