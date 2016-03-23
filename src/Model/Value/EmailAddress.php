<?php

/**
 * Includes an value object for an email address
 */

namespace Christianparadies\Equipment\Model\Value;

use Zend\Validator\Hostname;
use Zend\Validator\StaticValidator;

/**
 * provides a value object for an email address
 *
 * @author cparadies
 */
class EmailAddress
{
    /**
     * @var string email address
     */
    protected $email;
    /**
     * Initialize this email address
     *
     * @param string $email
     */
    public function __construct($email)
    {
        $this->email = $email;
        $this->validate();
    }
    
    /**
     * Validate the emailadress
     *
     * This validate methods use the validator from zend framework.
     * This validator allows dns.
     */
    public function validate()
    {
        $result = StaticValidator::execute(
            $this->email,
            'EmailAddress',
            array('allow' => Hostname::ALLOW_DNS)
        );
        
        if ($result === false) {
            $this->email = 'No valid email';
        }
    }
    
    /**
     * Get the emailaddress as string
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the emailaddress
     *
     * After set this emailaddress it will be validated
     * @param string $email
     * @return \Christianparadies\Equipment\Model\Value\EmailAddress
     */
    public function setEmail($email)
    {
        $this->email = $email;
        $this->validate();
        return $this;
    }
}
