<?php

require_once('Position.php');

class Robot
{

    private $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    public function setPosition(Position $position)
    {
        if ($position == null)
            return false;

        $this->position = $position;
        return true;
    }

    /**
     * Moves the robot one unit forward in the direction it is currently facing
     *
     * @return true if moved successfully
     */
    public function move()
    {
        //  Since PHP does not support constructor overloading func_num_args had to be used
        $arguments = func_num_args(); // get variable number of arguments
        if ($arguments == 1)
        {
            $newPosition = func_get_arg(0);
            if ($newPosition == null)
            {
                return false;
            }

            // change position
            $this->position = $newPosition;
            return true;
        }
        else
        {
            return $this->move($this->position->getNextPosition());
        }

    }

    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Rotates the robot 90 degrees LEFT
     *
     * @return true if rotated successfully
     */
    public function rotateLeft()
    {
        if ($this->position->getDirection() == null)
        {
            return false;
        }

        $direction = $this->position->getDirection();
        $direction->leftDirection();
        $this->position->setDirection($direction);

        return true;
    }

    /**
     * Rotates the robot 90 degrees RIGHT
     *
     * @return true if rotated successfully
     */
    public function rotateRight()
    {
        if ($this->position->getDirection() == null)
        {
            return false;
        }

        $direction = $this->position->getDirection();
        $direction->rightDirection();
        $this->position->setDirection($direction);

        return true;
    }
}