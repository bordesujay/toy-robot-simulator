<?php

require_once 'src/Position.php';

class PositionTest extends \Codeception\Test\Unit
{
    protected $position;

    protected function _before()
    {
        $this->position = new Position(1, 1, 'EAST');
    }

    protected function _after()
    {
    }

    /***
     * Test to check if the direction is set correctly
     */
    public function testShouldEqualToEastDirection()
    {
        $this->assertEquals('EAST', $this->position->getDirection());
    }

    public function testShouldCheckForInstanceOfPosition()
    {
        $dummyPosition1 = new Position(2, 3, new Direction('SOUTH'));
        $dummyPosition2 = new Position($dummyPosition1);

        $this->assertInstanceOf('Position', $this->position);
        $this->assertEquals($dummyPosition2, $dummyPosition1);
        $this->assertEquals(2, $dummyPosition1->getX());
        $this->assertEquals(3, $dummyPosition1->getY());
        $this->assertEquals(new Direction('SOUTH'), $dummyPosition1->getDirection());
    }

    public function testShouldCheckForNextPosition()
    {
        $direction = new Direction('WEST');

        $position1 = new Position(1, 1, $direction);
        $newPosition = $position1->getNextPosition();

        $position2 = new Position(0, 1, $direction);

        $this->assertEquals($position2, $newPosition);
    }
}