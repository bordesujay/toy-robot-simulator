<?php

class RobotException extends Exception
{
    public function __construct($string) {
        parent::__construct($string);
    }
}