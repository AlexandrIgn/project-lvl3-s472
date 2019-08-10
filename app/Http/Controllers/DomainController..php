<?php

namespace App\Http\Controllers;

use Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class DomainController extends BaseController
{
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "url" => "required|url"
        ]);
        if ($validator->fails()) {
            $error = 'You have entered an empty or non-existent URL';
            return view('navbar', ['error' => $error]);
        }
        $url = $request->input('url');
        $client = new Client();
        $response = $client->get($url);
        $contentLength = $response->getHeader('Content-Length')[0] ?? '';
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        $updated_at = Carbon::now();
        $created_at = Carbon::now();
        $id = DB::table('domains')->insertGetId([
            'name' => $url,
            'updated_at' => $updated_at,
            'created_at' => $created_at,
            'content_length' => $contentLength,
            'status_code' => $statusCode,
            'body' => $body
        ]);
        return redirect()->route('domains.show', ['id' => $id]);
    }

    public function show($id)
    {
        $domain = DB::table('domains')->find($id);
        return view('domain', ['domain' => $domain]);
    }

    public function index()
    {
        $domains = DB::table('domains')->paginate(7);
        return view('index', ['domains' => $domains]);
    }
}
