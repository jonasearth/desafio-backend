<?php

use Fnatic\Controllers\User\UserListController;
use Fnatic\Models\User;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
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
    public function testClientGet()
    {
        $this->assertIsNumeric(UserListController::findObj(1)->id);
    }

    public function testClientGetAll()
    {
        $users = UserListController::allObj();
        $this->assertIsObject($users[0]);
    }
}
