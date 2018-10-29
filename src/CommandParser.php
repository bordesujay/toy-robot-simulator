<?php
require_once('Command.php');

class CommandParser
{
    const pattern = array(
        Command::LEFT => '/^LEFT$/',
        Command::RIGHT => '/^RIGHT$/',
        Command::MOVE => '/^MOVE$/',
        Command::REPORT => '/^REPORT$/',
        Command::PLACE => '/^PLACE [0-9]+, [0-9]+, (?:NORTH|EAST|SOUTH|WEST)$/',
    );
    private $commandsArray = null;

    public function __construct($filename)
    {
        // check if file is valid and readable
        if (is_file($filename) && is_readable($filename))
        {
            // Breaking the lines by new line character and pushing each line into array
            $this->commandsArray = preg_split("/\R/", file_get_contents($filename));
        } else
        {
            print("Error: could not open/read file: " . $filename);
            return;
        }

        //  Find the invalid commands and remove them
        $this->removeInvalidCommands($this->findInvalidCommands());

    }

    /***
     * Function to remove invalid commands
     * @param $invalidCommands - array - Indexes of invalid commands
     */
    private function removeInvalidCommands($invalidCommands)
    {
        if (!empty($invalidCommands))
        {
            foreach ($invalidCommands as $invalidCommandIndex)
            {
                unset($this->commandsArray[$invalidCommandIndex]);
            }
            $this->commandsArray = array_values($this->commandsArray);
        }
    }

    /***
     * Function to find invalid commands and returning their indexes in an array
     * @return array - Indexes of invalid commands
     */
    private function findInvalidCommands()
    {

        $invalidCommands = array();
        $index = 0;
        foreach ($this->commandsArray as &$newCommand)
        {
            $newCommand = strtoupper($newCommand);
            if (!(
                $this->isMoveCommand($newCommand) ||
                $this->isLeftCommand($newCommand) ||
                $this->isRightCommand($newCommand) ||
                $this->isReportCommand($newCommand) ||
                $this->isPlaceCommand($newCommand)
            ))
            {
                //  pushing the index of invalid commands into an array - $invalidCommands
                $invalidCommands[] = $index;
            }
            $index++;
        }
        return $invalidCommands;
    }

    /**
     * Function to detect MOVE Command
     * @param $currentLine
     * @return bool - true if MOVE command else false
     */
    private function isMoveCommand($currentLine)
    {
        return $this->evaluatePattern(CommandParser::pattern[Command::MOVE], $currentLine);
    }

    /***
     * Function to evaluate pattern for currentLine
     * @param $pattern
     * @param $currentLine
     * @return bool - true is pattern matches else false
     */
    private function evaluatePattern($pattern, $currentLine)
    {
        $result = preg_match($pattern, $currentLine);

        if ($result == 1)
        {
            return true;
        } else
        {
            return false;
        }
    }

    /***
     * Function to detect LEFT Command
     * @param $currentLine
     * @return bool  - true if LEFT command else false
     */
    private function isLeftCommand($currentLine)
    {
        return $this->evaluatePattern(CommandParser::pattern[Command::LEFT], $currentLine);
    }

    /***
     * Function to detect RIGHT command
     * @param $currentLine
     * @return bool - true if RIGHT command else false
     */
    private function isRightCommand($currentLine)
    {
        return $this->evaluatePattern(CommandParser::pattern[Command::RIGHT], $currentLine);
    }

    /***
     * Function to detect REPORT command
     * @param $currentLine
     * @return bool - true if REPORT command else false
     */
    private function isReportCommand($currentLine)
    {
        return $this->evaluatePattern(CommandParser::pattern[Command::REPORT], $currentLine);
    }

    /***
     * Function to detect PLACE command
     * @param $currentLine
     * @return bool - true if PLACE command else false
     */
    private function isPlaceCommand(&$currentLine)
    {
        $placeCommandArray = explode(" ", $currentLine);

        if (trim($placeCommandArray[0]) != Command::PLACE)
        {
            return false;
        }

        $placeArray = explode(",", substr($currentLine, strpos($currentLine, Command::PLACE) + 5));

        foreach ($placeArray as &$value)
        {
            $value = trim($value);
        }

        $trimmedString = implode(", ", $placeArray);
        $currentLine = Command::PLACE . " " . $trimmedString;

        return $this->evaluatePattern(CommandParser::pattern[Command::PLACE], $currentLine);
    }

    /***
     * Getter function for commandsArray
     * @return array[]|false|null|string[]
     */
    public function getCommands()
    {
        return $this->commandsArray;
    }
}