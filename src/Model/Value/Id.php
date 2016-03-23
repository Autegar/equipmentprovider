<?php

/**
 * includes a class representing an ID value object
 */

namespace Christianparadies\Equipment\Model\Value;

/**
 * This class provides an ID as value object
 *
 * @author cparadies
 */
class Id
{
    /**
     * @var mixed various id
     */
    protected $id;
    
    /**
     * initialize this value object
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
    
    /**
     * Get the id from this value object
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id for this value object
     *
     * @param mixed $id
     * @return \Equipment\Model\Value\Id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
