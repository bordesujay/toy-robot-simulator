<?php

class Direction
{
    const DIRECTIONS = ['NORTH', 'EAST', 'SOUTH', 'WEST'];
    private $directionIndex;

    /***
     * Function to get the value of direction from index
     * @param $directionNum
     * @return mixed
     */
    public function valueOf($directionNum)
    {
        return self::DIRECTIONS[$directionNum];
    }

    public function getDirections()
    {
        return self::DIRECTIONS;
    }

    /***
     * function to set direction index
     * @param $direction
     */
    public function setDirection($direction)
    {
        $this->directionIndex = $direction;
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

        return $this->valueOf($newIndex);
    }
}