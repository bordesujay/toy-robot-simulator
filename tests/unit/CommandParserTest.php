<?php

require_once 'src/commandParser.php';

class CommandParserTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests for commands
    public function testShouldDetectAllCommandsAndRemoveInvalidCommands()
    {
        //assert "LEFT"
        $commandParser = new CommandParser('testfiles/Codeception_unit_test_files/left-command-file');
        $this->assertEquals(['LEFT'], $commandParser->getCommands());

        //assert "RIGHT"
        $commandParser = new CommandParser('testfiles/Codeception_unit_test_files/right-command-file');
        $this->assertEquals(['RIGHT'], $commandParser->getCommands());

        //assert "REPORT"
        $commandParser = new CommandParser('testfiles/Codeception_unit_test_files/report-command-file');
        $this->assertEquals(['REPORT'], $commandParser->getCommands());

        //assert "PLACE" command with exact spacing/position and case.
        $commandParser = new CommandParser('testfiles/Codeception_unit_test_files/place-command-file');
        $this->assertEquals(['PLACE 0, 0, SOUTH'], $commandParser->getCommands());

        //assert move
        $commandParser = new CommandParser('testfiles/Codeception_unit_test_files/move-command-file');
        $this->assertEquals(['MOVE'], $commandParser->getCommands());

        //test file with mixed commands
        $commandParser = new CommandParser('testfiles/Codeception_unit_test_files/mixed-command-file');
        $this->assertEquals([
            'MOVE',
            'LEFT',
            'RIGHT',
            'REPORT',
            'PLACE 0, 0, NORTH'
        ], $commandParser->getCommands());

        //file with errors
        $commandParser = new CommandParser('testfiles/Codeception_unit_test_files/error-file');
        $this->assertInstanceOf('CommandParser', $commandParser);

    }

    public function testShouldHandleInvalidCommands()
    {
        /*
        *  test file with invalid commands handling (clean up strings)
        *  array keys after removing error elements from array
        */
        $commandParser = new CommandParser('testfiles/Codeception_unit_test_files/bad-commands');
        $this->assertEquals([
            'PLACE 0, 0, SOUTH',
            'RIGHT',
            'MOVE',
            'LEFT',
            'REPORT'
        ], $commandParser->getCommands());

    }
}