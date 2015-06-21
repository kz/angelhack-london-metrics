<?php

namespace Metrics\Idol;

use Carbon\Carbon;
use GuzzleHttp;
use GuzzleHttp\Promise;
use GuzzleHttp\Client;

class Idol {

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var String
     */
    private $api_key;

    public function __construct(Client $client, array $config) {
        $this->client = $client;
        $this->config = $config;
        $this->api_key = $this->config['api_key'];
    }

    public function queryTextIndexByKeyword($keyword, $min_date = null, $max_date = null, $max_results = 20, $indexes = 'news_eng') {
        $response = $this->client->post('https://api.idolondemand.com/1/api/sync/querytextindex/v1', [
            'form_params' => [
                'text' => $keyword,
                'min_date' => $min_date,
                'max_date' => $max_date,
                'indexes' => $indexes,
                'apikey' => $this->api_key,
                'max_results' => $max_results
            ]
        ], ['verify' => false]);

        $json = json_decode((string) $response->getBody(), true);

        if (!$json && !array_key_exists('documents', $json)) {
            return response()->json(['message' => 'No documents found.'], 404);
        }

        $documents = $json['documents'];
        // TODO - Resolve title duplicates
        $this->analyseSentiments($documents);
    }

    public function analyseSentiments($documents){
        $client = $this->client;

        if (!$documents) {
            return response()->json(['message' => 'No URLs received.'], 400);
        }

        $results = [];

        foreach ($documents as $document) {
            $request = $client->post('https://api.idolondemand.com/1/api/sync/analyzesentiment/v1', [
                    'form_params' => [
                    'url' => $document['reference'],
                    'apikey' => $this->api_key
                ]
            ], ['verify' => 'false']);
            $response = json_decode((string) $request->getBody(), true);
            $score = (int) ($response['aggregate']['score'] * 100);
            $results[] = ['title' => $document['title'], 'url' => $document['reference'], 'sentiment' => $response['aggregate']['sentiment'], 'score' => $score];
        }
//        dd($results);
        return response()->json(['results' => $results], 200);
    }

}