<?php

require_once('Robot.php');
require_once('Table.php');
require_once('Command.php');

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

    public function execute($inputString)
    {
        $args = explode(" ", $inputString);
        $command = $args[0];
        $output = null;

        switch ($command)
        {
            case Command::PLACE:
                $placeParams = explode(",", substr($inputString, strpos($inputString, Command::PLACE) + 5));
                $x = (int)$placeParams[0];
                $y = (int)$placeParams[1];
                $direction = new Direction($placeParams[2]);
                $this->placeToyRobot(new Position($x, $y, $direction));
                break;
            case Command::MOVE:
                $this->robot->move();
                break;
            case Command::LEFT:
                $this->robot->rotateLeft();
                break;
            case Command::RIGHT:
                $this->robot->rotateRight();
                break;
            case Command::REPORT:
                $output = $this->report();
                break;
            default:
                break;
        }

        return $output;
    }
}