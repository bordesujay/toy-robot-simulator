<?php

require_once 'src/Direction.php';

class DirectionTest extends \Codeception\Test\Unit
{
    protected $direction;

    protected function _before()
    {
        $this->direction = new Direction();
    }

    protected function _after()
    {
    }

    /**
     * Test to check left rotation when facing north
     */
    public function testShouldRotateFromNorthToWestWhenTurnedLeft()
    {
        $this->direction->setDirection(0);
        $this->assertEquals('WEST', $this->direction->leftDirection());
    }

    public function testShouldRotateFromNorthToEastWhenTurnedRight()
    {
        $this->direction->setDirection(0);
        $this->assertEquals('EAST', $this->direction->rightDirection());
    }
}