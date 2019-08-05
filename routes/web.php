<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use DiDom\Document;
$document = app(Document::class);
$document->loadHtmlFile('https://royal-zed-51774.herokuapp.com/');
$header = $document->find('h1')[0]->text();
dump($header);

$router->get('/', function () use ($router) {
    return view('navbar', []);
});

$router->post('/domains', [
    'as' => 'domains.store', 'uses' => 'DomainController@store'
    ]);

$router->get('/domains/{id}', [
    'as' => 'domains.show', 'uses' => 'DomainController@show'
    ]);

$router->get('/domains', [
    'as' => 'domains.index', 'uses' => 'DomainController@index'
    ]);
