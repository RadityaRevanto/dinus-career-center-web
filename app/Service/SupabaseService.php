<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SupabaseService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('SUPABASE_URL');
        $this->apiKey = env('SUPABASE_KEY');
    }
    
    private function client()
    {
        $client = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->baseUrl($this->baseUrl);

        if (Session::has('supabase_token')) {
            $client->withToken(Session::get('supabase_token'));
        } else {
            $client->withToken($this->apiKey);
        }
        return $client;
    }
}