<?php

namespace Metrics\Idol;

use Carbon\Carbon;
use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Thujohn\Twitter\Facades\Twitter;

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

    public function queryTwitterWithKeyword($keyword, $count = 30){
        $twitter = Twitter::getSearch([
            'q' => $keyword,
            'result_type' => 'recent',
            'lang' => 'en',
            'count' => $count
        ]);
        $statuses = $twitter->statuses;
        $documents = [];
        foreach ($statuses as $status) {
            $documents[] = [
                'content' => $status->text,
                'title' => $status->id,
                'reference' => $status->id
            ];
        }
        return $this->analyseSentiments($documents);
    }

    public function queryTextIndexWithTicker($keyword, $max_results = 35, $indexes = 'news_eng'){
        $carbon = Carbon::now();
        $today = $carbon->timestamp . 'e';
        $yesterday = $carbon->subDay()->timestamp . 'e';
        $day_before_yesterday = $carbon->subDay(2)->timestamp . 'e';
        $today_news =  $this->queryTextIndexByKeyword($keyword, $yesterday, $today, $max_results, $indexes);
        $yesterday_news =  $this->queryTextIndexByKeyword($keyword, $day_before_yesterday, $yesterday, $max_results, $indexes);
        $today_score = $today_news['aggregate']['score'];
        $yesterday_score = $yesterday_news['aggregate']['score'];
        return [
            'aggregate' => [
                'score_change' => $today_score - $yesterday_score
            ],
            'today' => $today_news,
            'yesterday' => $yesterday_news
        ];
    }

    public function queryTextIndexByKeyword($keyword, $min_date = null, $max_date = null, $max_results = 35, $indexes = 'news_eng') {
        try {
            $response = $this->client->post('https://api.idolondemand.com/1/api/sync/querytextindex/v1', [
                'form_params' => [
                    'text' => $keyword,
                    'min_date' => $min_date,
                    'max_date' => $max_date,
                    'indexes' => $indexes,
                    'print' => 'all',
                    'apikey' => $this->api_key,
                    'max_results' => $max_results,
                    'min_score' => '50'
                ]
            ], ['verify' => false]);
        } catch (\Exception $e) {
            throw new \Exception('An error occurred while trying to access IDOL OnDemand.', 500);
        }

        $json = json_decode((string) $response->getBody(), true);

        if (!$json && !array_key_exists('documents', $json)) {
            throw new \Exception('No news articles have been found.', 404);
        }

        $documents = $json['documents'];

        $deduplicate = [];
        foreach ($documents as $key => &$document) {
            $title = $document['title'];
            if (in_array($title, $deduplicate)) {
                unset($documents[$key]);
            }
            $deduplicate[$key] = $title;
        }
        $documents = array_values($documents);

        if (!$documents) {
            throw new \Exception('No news articles have been found.', 404);
        }

        try {
            return $this->analyseSentiments($documents);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function analyseSentiments($documents){
        $client = $this->client;

        if (!$documents) {
            throw new \Exception('No news articles have been found.', 404);
        }

        $aggregate_score = 0;
        $news_analytics = [];

        $promises = [];
        foreach ($documents as $key => $document) {
            $promises[] = $client
                ->postAsync(
                    'https://api.idolondemand.com/1/api/sync/analyzesentiment/v1',
                    [
                        'form_params' => [
                            'text' => $document['content'],
                            'apikey' => $this->api_key
                        ]
                    ],
                    ['verify' => 'false']
                )
                ->then(
                    function(ResponseInterface $res) use($document, &$aggregate_score, &$news_analytics)
                    {
                        $result = json_decode((string) $res->getBody(), true);

                        $score = (int) ($result['aggregate']['score'] * 100);
                        $aggregate_score += $score;

                        $news_analytics[] = [
                            'title' => $document['title'],
                            'url' => $document['reference'],
                            'sentiment' => $result['aggregate']['sentiment'],
                            'score' => $score
                        ];
                    },
                    function(RequestException $e) {
                        // Ignore?
                    }
                )
            ;
        }

        if (!count($promises)) {
            return [];
        }

        $results = Promise\unwrap($promises);

        $aggregate_score = (int) ($aggregate_score / count($results));

        if (!$results) {
            throw new \Exception('No sentiment results could be found.', 404);
        }

        return [
            'aggregate' => [
                'score' => $aggregate_score,
                'sentiment' => ($aggregate_score >= 0) ? 'positive' : 'negative',
            ],
            'news_analytics' => $news_analytics
        ];
    }

}