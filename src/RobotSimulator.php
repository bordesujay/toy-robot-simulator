<?php

require_once('Robot.php');
require_once('Table.php');

class RobotSimulator
{
    private $robot;
    private $table;

    /***
     * RobotSimulator constructor.
     * @param Table $table
     * @param Robot $robot
     */
    public function __construct(Table $table, Robot $robot)
    {
        $this->table = $table;
        $this->robot = $robot;
    }

    /***
     * Places the robot on the squareBoard  in position X,Y and facing NORTH, SOUTH, EAST or WEST
     * @param Position $position
     * @return bool - true if placed successfully
     * @throws Exception
     */
    public function placeToyRobot(Position $position)
    {

        if ($this->table == null)
            return false;

        if ($position == null)
            return false;

        if ($position->getDirection() == null)
            return false;

        // validate the position
        if (!$this->table->isValidPosition($position))
            return false;

        // if position is valid then assign values to fields
        $this->robot->setPosition($position);
        return true;
    }

    /**
     * Returns the X,Y and Direction of the robot
     */
    public function report()
    {
        if ($this->robot->getPosition() == null)
            return null;

        $position = $this->robot->getPosition();
        $direction = $position->getDirection();
        return $position->getX() . "," . $position->getY() . "," . $direction->getDirectionValue();
    }
}