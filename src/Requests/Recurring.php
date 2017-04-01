<?php
namespace Settlement\GMO\Payment\Gateway\Requests;


class Recurring extends Request
{
    public function create($params)
    {
        $this->response = $this->client->post('/payment/RegisterRecurringCredit.idPass', $params);
        return $this;
    }

    public function search($params)
    {
        $this->response = $this->client->post('/payment/SearchRecurring.idPass', $params);
        return $this;
    }

    public function update($params)
    {
        $this->response = $this->client->post('/payment/ChangeRecurring.idPass', $params);
        return $this;
    }

    public function delete($params)
    {
        $this->response = $this->client->post('/payment/UnregisterRecurring.idPass', $params);
        return $this;
    }

    public function status($params)
    {
        $this->response = $this->client->post('/payment/SearchRecurringResult.idPass', $params);
        return $this;
    }
}