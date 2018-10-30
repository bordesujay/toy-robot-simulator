<?php

require_once('Position.php');

class Robot
{

    private $position = null;

    public function __construct(Position $position = null)
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

    /***
     * Moves the robot one unit forward in the direction it is currently facing
     * @param Position|null $newPosition
     * @return bool - true if moved successfully
     */
    public function move(Position $newPosition = null)
    {
        //  if current position of robot is not set then it will not move
        if($this->position == null)
        {
            return false;
        }

        if($newPosition == null)
        {
            $this->move($this->position->getNextPosition());
        }

        $this->position = $newPosition;
        return true;
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
        //  if current position of robot is not set then it will not rotate
        if($this->position == null)
        {
            return false;
        }

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
        //  if current position of robot is not set then it will not rotate
        if($this->position == null)
        {
            return false;
        }

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