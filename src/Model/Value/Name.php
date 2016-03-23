<?php

/**
 * Includes an value object representing a name
 */

namespace Christianparadies\Equipment\Model\Value;

/**
 * A value object to represent a name
 *
 * @author cparadies
 */
class Name
{
    /**
     * @var string The name
     */
    protected $name;
    
    /**
     * @var string The surname
     */
    protected $surname;
    
    /**
     * initialize this value object name
     *
     * @param string $name
     * @param string $surname
     */
    public function __construct($name, $surname = "")
    {
        $this->name = $name;
        $this->surname = $surname;
    }
    
    /**
     * Get the first name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the firstname
     *
     * @param string $name
     * @return \Equipment\Model\Value\Name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set the surname
     *
     * @param string $surname
     * @return \Equipment\Model\Value\Name
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }
    
    /**
     * Get the full name cosisting of fistname and surname
     *
     * If both are set the name will be separated with a space
     * @return string
     */
    public function getFullName()
    {
        if ($this->surname != "" && $this->name != "") {
            $fullName = $this->name . ' ' . $this->surname;
        } else {
            if ($this->name != "") {
                $fullname = $this->name;
            }
            if ($this->surname != "") {
                $fullname = $this->surname;
            }
        }
        
        return $fullName;
    }
}
