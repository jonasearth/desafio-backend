<?php

use Fnatic\Services\Auth\AuthHandler;
use PHPUnit\Framework\TestCase;

class MultipleDependenciesTest extends TestCase
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
    public function testAuthLogin()
    {

        $this->assertIsString(AuthHandler::createAdminToken(["id" => "1"]));
    }
}
