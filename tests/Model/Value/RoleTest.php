<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 24.03.16
 * Time: 16:24
 */

namespace Christianparadies\Equipment\tests\Model\Value;


use Christianparadies\Equipment\Model\Value\Role;

class RoleTest extends \PHPUnit_Framework_TestCase
{
    public function testNewRole()
    {
        $role = new Role(['Caretaker']);

        $this->assertEquals('Caretaker', $role->getRole('Caretaker'), 'Role was not correctly returned');
    }

    public function testSetter()
    {
        $role = new Role(['Caretaker']);

        $role->setRole(['Draft']);

        $this->assertEquals('Draft', $role->getRole('Draft'), 'Role was not correctly returned');
    }

    public function testRoleCollection()
    {
        $roles = new Role(['Test','Draft', 'Caretaker']);

        $this->assertTrue(is_array($roles->getRole()), 'Roles should be returned as an array.');
        $this->assertEquals('Caretaker', $roles->getRole('Caretaker'), 'Tried to catch the role caretaker. But not possible.');
    }
}
