<?php

namespace Settlement\GMO\Payment\Gateway;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Class Client
 * @package Settlement\GMO\Payment\Gateway
 */
class Client
{
    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var LoggerInterface */
    protected $logger;

    public function __construct($base_uri, $options, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $config = ['base_uri' => $base_uri] + $options;
        $this->client = new \GuzzleHttp\Client($config);
    }

    /**
     * @return Logger|LoggerInterface
     */
    protected function logger()
    {
        if($this->logger) {
            return $this->logger;
        }
        $path = __DIR__ . '/../log';
        $logger = new Logger('ClientLog');
        $logger->pushHandler(new RotatingFileHandler($path. '/client', 7));
        return $this->logger = $logger;
    }

    /**
     * @param $uri
     * @param array $params
     * @param array $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function get($uri, $params = [], $headers = [])
    {
        $options = [
            'headers' => $headers,
            'query' => $params,
        ];
        $response = $this->client->request('GET', $uri, $options);
        return $response;
    }

    /**
     * @param $uri
     * @param array $params
     * @param array $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function post($uri, $params = [], $headers = [])
    {
        $options = [
            'headers' => $headers,
            'form_params' => $params,
        ];
        $response = $this->client->request('POST', $uri, $options);
        return $response;
    }
}
