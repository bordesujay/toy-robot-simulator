<?php

require_once('src/Robot.php');
require_once('src/Position.php');

class RobotTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * This test covers rotate left, right and move
     */
    public function testShouldCreateRobotInstanceAndRotateLeftAndRightAndMove()
    {
        $position1 = new Position(0, 0, new Direction('NORTH'));
        $finalPosition = new Position(1, 1, new Direction('NORTH'));
        $robot = new Robot($position1);
        $robot->rotateLeft();

        $this->assertEquals(new Position(0, 0, new Direction('WEST')), $robot->getPosition());

        $robot->rotateRight();

        $this->assertEquals(new Position(0, 0, new Direction('NORTH')), $robot->getPosition());

        $robot->rotateRight();

        $this->assertEquals(new Position(0, 0, new Direction('EAST')), $robot->getPosition());

        $robot->move();

        $this->assertEquals(new Position(1, 0, new Direction('EAST')), $robot->getPosition());

        $robot->rotateLeft();

        $this->assertEquals(new Position(1, 0, new Direction('NORTH')), $robot->getPosition());

        $robot->move();
        $this->assertEquals($finalPosition, $robot->getPosition());
    }
}