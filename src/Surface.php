<?php

require_once('Position.php');

/***
 * Interface Surface - to implement isValidPosition for surface of any shape and size
 */
interface Surface
{
    public function isValidPosition(Position $position);
}