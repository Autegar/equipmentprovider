<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Christianparadies\Equipment\Model\Value;

/**
 * Description of Role
 *
 * @author cparadies
 */
class Role
{
    /**
     * @var array
     */
    protected $role;
    
    public function __construct(array $role)
    {
        if (is_null($role)) {
            $role = array();
        }
        $this->role = $role;
    }
    
    public function getRole($role = '')
    {
        if ($role !== '') {
            return $this->getRoleFromArray($role);
        }
        return $this->role;
    }

    private function getRoleFromArray($role)
    {
        foreach ($this->role as $roleItem) {
            if ($roleItem === $role) {
                return $roleItem;
            }
        }

        return '';
    }

    public function setRole(array $role)
    {
        $this->role = $role;
        return $this;
    }
}
