<?php
/**
 * Created by PhpStorm.
 * User: cparadies
 * Date: 23.03.16
 * Time: 16:42
 */

namespace Christianparadies\Equipment\Tests\Service;


class AbstractCommandTest extends \PHPUnit_Framework_TestCase
{
    protected $stub = null;

    public function setUp()
    {
        parent::setUp();
        $this->stub = $this->getMockForAbstractClass('Christianparadies\Equipment\Service\AbstractCommand');
    }

    public function testStub()
    {
        var_dump($this->stub);
    }
}