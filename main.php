<?php
require_once ('src/Table.php');
require_once ('src/Robot.php');
require_once ('src/RobotSimulator.php');
require_once ('src/CommandParser.php');

$commandParser = new CommandParser($argv[1]);
$commandList = $commandParser->getCommands();

$table = new Table(4, 4);
$robot = new Robot(null);
$simulator = new RobotSimulator($table, $robot);

foreach ($commandList as $command)
{
    $output = $simulator->execute($command);
    if(isset($output))
        echo $output."\n";
}