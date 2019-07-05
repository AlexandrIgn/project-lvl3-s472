<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AplicationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAplication()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }
}
