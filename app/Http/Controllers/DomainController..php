<?php

namespace App\Http\Controllers;

use Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use DiDom\Document;
use App\Domain;

class DomainController extends BaseController
{
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "url" => "required|url"
        ]);
        if ($validator->fails()) {
            $error = 'You have entered an empty or non-existent URL';
            return view('seotest', ['error' => $error]);
        }
        $url = $request->input('url');
        $client = app(Client::class);
        $response = $client->get($url);
        $contentLength = $response->getHeader('Content-Length')[0] ?? '';
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        $document = app(Document::class);
        $document->loadHtmlFile($url);
        if ($document->has('h1')) {
            $header = $document->find('h1')[0]->text();
        }
        if ($document->has('meta[name=keywords]')) {
            $keywords = $document->find('meta[name=keywords]')[0]->getAttribute('content');
        }
        if ($document->has('meta[name=description]')) {
            $description = $document->find('meta[name=description]')[0]->getAttribute('content');
        }
        $domain = Domain::create([
            'name' => $url,
            'content_length' => $contentLength,
            'status_code' => $statusCode,
            'body' => $body,
            'header' => $header ?? '',
            'keywords' => $keywords ?? '',
            'description' => $description ?? ''
        ]);
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }

    public function show($id)
    {
        $domain = Domain::find($id);
        return view('domain', ['domain' => $domain]);
    }

    public function index()
    {
        $domains = Domain::paginate(5);
        return view('index', ['domains' => $domains]);
    }
}
