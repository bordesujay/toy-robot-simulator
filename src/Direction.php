<?php

class Direction
{
    const DIRECTIONS = ['NORTH', 'EAST', 'SOUTH', 'WEST'];
    private $directionIndex;

    public function __construct($directionValue)
    {
        $this->directionIndex =  $this->indexOf($directionValue);
    }

    /***
     * Function to get the value of direction from index
     * @param $directionNum
     * @return mixed
     */
    public function valueOf($directionNum)
    {
        return self::DIRECTIONS[$directionNum];
    }

    public function indexOf($directionValue)
    {
        return array_search($directionValue, self::DIRECTIONS);
    }

    public function getDirectionIndex()
    {
        return $this->directionIndex;
    }

    public function getDirectionValue()
    {
        return self::DIRECTIONS[$this->directionIndex];
    }

    /***
     * function to set direction index
     * @param $directionNumber
     */
    public function setDirectionIndex($directionNumber)
    {
        $this->directionIndex = $directionNumber;
    }

    /**
     * Returns the direction on the left of the current one
     */
    public function leftDirection()
    {
        return $this->rotate(-1);
    }

    /**
     * Returns the direction on the right of the current one
     */
    public function rightDirection()
    {
        return $this->rotate(1);
    }

    private function rotate($step)
    {
        $newIndex = ($this->directionIndex + $step) < 0 ?
            count(self::DIRECTIONS) - 1 :
            ($this->directionIndex + $step) % count(self::DIRECTIONS);

        $this->setDirectionIndex($newIndex);

        return $this->valueOf($newIndex);
    }
}