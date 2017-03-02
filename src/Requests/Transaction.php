<?php
/**
 * Created by PhpStorm.
 * User: mediaash
 * Date: 2017/03/02
 * Time: 14:17
 */

namespace Settlement\GMO\Payment\Gateway\Requests;


class Transaction extends Request
{
    public function create($params)
    {
        $this->response = $this->client->post('/payment/EntryTran.idPass', $params);
        return $this;
    }

    public function search($params)
    {
        $this->response = $this->client->post('/payment/SearchTrade.idPass', $params);
        return $this;
    }

    public function update($params)
    {
        $this->response = $this->client->post('/payment/AlterTran.idPass', $params);
        return $this;
    }

    public function change($params)
    {
        $this->response = $this->client->post('/payment/ChangeTran.idPass', $params);
        return $this;
    }

    public function execute($params)
    {
        $this->response = $this->client->post('/payment/ExecTran.idPass', $params);
        return $this;
    }
}