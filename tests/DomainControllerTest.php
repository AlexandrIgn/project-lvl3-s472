<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;

class DomainControllerTest extends \TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testHome()
    {
        $this->get('/');
        $this->assertResponseStatus(200);
    }

    public function testIndex()
    {
        $domain = factory('App\Domain')->create();
        $this->get('/domains');
        $this->assertResponseStatus(200);
    }

    public function testStore()
    {

        $html = file_get_contents('tests/fixtures/testpage.html');
        $response = new Response(111, ['Content-Length' => 'Bar'], $html);
        $mock = new MockHandler([new Response(111, ['Content-Length' => 'Bar'], $html)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $this->app->instance(Client::class, $client);
        $this->call('POST', route('domains.store'), ['url' => 'https://laravel.com/docs/5.8/mocking']);
        $this->seeInDatabase('domains', ['status_code' => 111]);
        $this->seeInDatabase('domains', ['header' => "header"]);
        $this->seeInDatabase('domains', ['description' => "This is description!"]);
    }

    public function testShow()
    {
        $domain = factory('App\Domain')->create();
        $this->get('/domains/' . $domain->id);
        $this->assertResponseStatus(200);
    }
}
