<?php

use Fnatic\Controllers\Moviment\MovimentListController;
use Fnatic\Controllers\User\UserListController;
use Fnatic\Models\User;

use PHPUnit\Framework\TestCase;

class MovimentTest extends TestCase
{
    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    /**
     * @depends testProducerFirst
     * @depends testProducerSecond
     */
    public function testMovimentGet()
    {
        $this->assertIsNumeric(MovimentListController::byUserObj(1)->id);
    }

    public function testMovimentByMon()
    {
        $moviments = MovimentListController::getByMonthReport(1, '04/2021');
        $this->assertIsObject($moviments);
    }
    public function testMovimentLastMon()
    {
        $moviments = MovimentListController::getLastMonthReport(1);
        $this->assertIsObject($moviments);
    }
}
