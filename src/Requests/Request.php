<?php
namespace Settlement\GMO\Payment\Gateway\Requests;


use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Settlement\GMO\Payment\Gateway\Client;
use Settlement\GMO\Payment\Gateway\Entities\Entity;

/**
 * Class RequestModel
 * @package Settlement\GMO\Payment\Gateway\Requests
 */
class Request
{
    /** @var Client */
    protected $client;

    /** @var ResponseInterface */
    protected $response;

    public function __construct(Client $client, LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * @return Entity
     */
    public function response()
    {
        $result = $this->response->getBody()->getContents();
        return new Entity($result);
    }
}