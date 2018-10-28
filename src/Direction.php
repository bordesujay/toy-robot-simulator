<?php

class Direction
{
    private $DIRECTIONS = ['NORTH', 'EAST', 'SOUTH', 'WEST'];
    private $directionIndex;

    /***
     * Function to get the value of direction from index
     * @param $directionNum
     * @return mixed
     */
    public function valueOf($directionNum)
    {
        return $this->DIRECTIONS[$directionNum];
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
            count($this->DIRECTIONS) - 1 :
            ($this->directionIndex + $step) % count($this->DIRECTIONS);

        return $this->valueOf($newIndex);
    }
}