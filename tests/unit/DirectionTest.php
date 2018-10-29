<?php

require_once 'src/Direction.php';

class DirectionTest extends \Codeception\Test\Unit
{

    protected function _before()
    {

    }

    protected function _after()
    {
    }

    /**
     * Test to check left rotation when facing north
     */
    public function testShouldRotateFromNorthToWestWhenTurnedLeft()
    {
        $direction = new Direction('NORTH');
        $this->assertEquals('WEST', $direction->leftDirection());
    }

    public function testShouldRotateFromNorthToEastWhenTurnedRight()
    {
        $direction = new Direction('NORTH');
        $this->assertEquals('EAST', $direction->rightDirection());
    }
}