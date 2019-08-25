<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use DiDom\Document;

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
        $response = $this->call('GET', route('home'));
        $this->assertEquals(200, $response->status());
    }

    public function testIndex()
    {
        $response = $this->call('GET', route('domains.index'));
        $this->assertEquals(200, $response->status());
    }

    public function testStore()
    {
        $client = $this->getMockBuilder(Client::class)
                        ->setMethods(['get'])
                        ->getMock();
        $response = new Response(111, ['Content-Length' => 'Bar'], 'This is body!');
        $client->method('get')
                ->willReturn($response);
        $this->app->instance(Client::class, $client);
        $document = new Document('tests/fixtures/testpage.html', true);
        $document = $this->getMockBuilder(Document::class)
        ->setConstructorArgs(array('tests/fixtures/testpage.html', true))
        ->setMethods(array('loadHtmlFile'))
        ->getMock();
        $this->app->instance(Document::class, $document);
        $this->call('POST', route('domains.store'), ['url' => 'https://laravel.com/docs/5.8/mocking']);
        $this->seeInDatabase('domains', ['body' => 'This is body!']);
        $this->seeInDatabase('domains', ['status_code' => 111]);
        $this->seeInDatabase('domains', ['header' => "header"]);
        $this->seeInDatabase('domains', ['description' => "This is description!"]);
    }

    public function testShow()
    {
        $domain = factory('App\Domain')->create();
        $response = $this->call('GET', route('domains.show', ['id' => $domain->id]));
        $this->assertEquals(200, $response->status());
    }
}
