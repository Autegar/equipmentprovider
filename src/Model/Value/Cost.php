<?php

/**
 * Includes a cost value object to crypt something
 */

namespace Christianparadies\Equipment\Model\Value;

/**
 * This value object provides a structure for bcrypt cost value
 *
 * @author cparadies
 */
class Cost
{
    /**
     * @var int cost factor
     */
    protected $cost;
    
    /**
     * initialize this cost value object
     *
     * @param int $cost
     */
    public function __construct($cost)
    {
        $this->cost = $cost;
    }
    
    /**
     * Get cost from this value object
     *
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Modify the cost value for this object
     *
     * @param int $cost
     * @return \Christianparadies\Equipment\Model\Value\Cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }
}
