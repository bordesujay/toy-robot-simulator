<?php

require_once('Robot.php');
require_once('Table.php');
require_once('Command.php');
require_once('CommandParser.php');
require_once ('RobotException.php');

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

    public function execute($inputString)
    {
        $args = explode(" ", $inputString);
        $command = $args[0];
        $output = null;

        switch ($command)
        {
            case Command::PLACE:
                $command = new CommandParser();
                $placeParams = $command->createPlaceCommandParams($inputString);
                $x = $placeParams[0];
                $y = $placeParams[1];
                $direction = new Direction($placeParams[2]);
                $this->placeRobot(new Position($x, $y, $direction));
                break;

            case Command::MOVE:
                if ($this->robot->getPosition() == null)
                    break;

                $currentPos = $this->robot->getPosition();
                $newPos = $currentPos->getNextPosition();
                if ($this->table->isValidPosition($newPos))
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

    /***
     * Places the robot on the squareBoard  in position X,Y and facing NORTH, SOUTH, EAST or WEST
     * @param Position $position
     * @return bool - true if placed successfully
     */
    public function placeRobot(Position $position)
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
        $delimiter = ",";
        return $position->getX() . $delimiter . $position->getY() . $delimiter . $direction->getDirectionValue();
    }
}