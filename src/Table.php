<?php

require_once('Surface.php');
require_once('Position.php');

class Table implements Surface
{
    private $x;
    private $y;

    public function __construct($x = 1, $y = 1)
    {
        $this->x = $x;
        $this->y = $y;
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

    /***
     * Function to find if the position is valid
     * @param Position $position
     * @return bool - true if the x,y coordinates location if valid else false
     */
    public function isValidPosition(Position $position)
    {
        $isInt = is_int($position->getX()) && is_int($position->getY());

        $Range = (
            $position->getX() >= 0 &&
            $position->getY() >= 0 &&
            $position->getX() < $this->getX() &&
            $position->getY() < $this->getY());

        return ($isInt && $Range);
    }

}