<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AplicationTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHome()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }

    public function testDomains()
    {
        $response = $this->call('GET', '/domains');
        $this->assertEquals(200, $response->status());
    }

    public function testDataBase()
    {
        $this->call('POST', '/domains', ['url' => 'https://ru.hexlet.io/my']);
        $this->seeInDatabase('domains', ['name' => 'https://ru.hexlet.io/my']);
    }
}
