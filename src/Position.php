<?php

require_once ('RobotException.php');
require_once ('Direction.php');

class Position
{
    private $x;
    private $y;
    private $direction;

    /***
     * Position constructor.
     */
    public function __construct()
    {
        //  Since PHP does not support constructor overloading func_num_args had to be used
        $arguments = func_num_args(); // get variable number of arguments
        if ($arguments == 1)
        {
            $position = func_get_arg(0);
            $this->x = $position->getX();
            $this->y = $position->getY();
            $this->direction = $position->getDirection();
        } else
        {
            $this->x = func_get_arg(0);
            $this->y = func_get_arg(1);
            $this->direction = func_get_arg(2);
        }
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param mixed $direction
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /****
     * Function to change location
     * @param $x
     * @param $y
     */
    public function changePosition($x, $y)
    {
        $this->x = $this->x + $x;
        $this->y = $this->y + $y;
    }

    /***
     * * Function to get the next position depending on the location
     * @param int $steps
     * @return Position
     */
    public function getNextPosition($steps = 1)
    {
        if ($this->getX() == null || $this->getY() == null || $this->getDirection() == null)
            return null;

        // new position to validate
        $newPosition = new Position($this);

        switch ($this->direction->getDirectionValue())
        {
            case 'NORTH':
                $newPosition->changePosition(0, $steps);
                break;
            case 'EAST':
                $newPosition->changePosition($steps, 0);
                break;
            case 'SOUTH':
                $newPosition->changePosition(0, (-1 * $steps));
                break;
            case 'WEST':
                $newPosition->changePosition((-1 * $steps), 0);
                break;
        }
        return $newPosition;
    }
}