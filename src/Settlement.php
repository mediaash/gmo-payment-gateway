<?php
namespace Settlement\GMO\Payment\Gateway;

use Settlement\GMO\Payment\Gateway\Exceptions\Exception;
use Settlement\GMO\Payment\Gateway\Requests\CreditCard;
use Settlement\GMO\Payment\Gateway\Requests\Customer;
use Settlement\GMO\Payment\Gateway\Requests\Recurring;
use Settlement\GMO\Payment\Gateway\Requests\Transaction;

class Settlement
{
    /** @var  Client */
    protected static $client;

    protected static $aliases = [
        'CreditCard' => CreditCard::class,
        'Customer' => Customer::class,
        'Recurring' => Recurring::class,
        'Transaction' => Transaction::class,
    ];

    public function __construct($base_uri, $options = [])
    {
        $this->client($base_uri, $options);
    }

    protected function client($base_uri, $options = [])
    {
        if(self::$client) {
            return self::$client;
        }
        return self::$client = new Client($base_uri, $options);
    }

    public function make($request)
    {
        if(in_array($request, static::$aliases)) {
            return new $request(static::$client);
        }
        if(key_exists($request, static::$aliases)) {
            return $this->make(static::$aliases[$request]);
        }
        throw new Exception('not support request');
    }
}