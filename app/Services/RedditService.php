<?php


namespace App\Services;
use GuzzleHttp\Client;

class RedditService
{
    protected $client;

    /**
     * RedditService constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://www.reddit.com/r/showerthoughts/.json?limit=100']);
    }


    public function handle()
    {
        $response = $this->client->request('GET','',[
            'headers' => [
                'User-Agent' => 'testing/0.1'
            ]
        ]);
        $data = json_decode($response->getBody()->getContents());
        return $data->data->children;

    }
}