<?php
require_once 'src/table.php';

class TableTest extends \Codeception\Test\Unit
{
    protected $table;

    protected function _before()
    {
        $this->table = new table(5, 5);
    }

    protected function _after()
    {
    }

    public function testShouldCheckForTheCreatedTableInstance()
    {
        $this->assertInstanceOf('table', $this->table);
    }

    public function testShouldGetXDimensionSize()
    {
        $this->assertEquals(5, $this->table->getX());
    }

    public function testShouldGetYDimensionSize()
    {
        $this->assertEquals(5, $this->table->getY());
    }
}