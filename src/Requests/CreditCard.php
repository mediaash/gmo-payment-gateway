<?php
namespace Settlement\GMO\Payment\Gateway\Requests;


class CreditCard extends Request
{
    public function insert($params)
    {
        $this->response = $this->client->post('/payment/SaveCard.idPass', $params);
        return $this;
    }

    public function update($params)
    {
        $this->response = $this->client->post('/payment/SaveCard.idPass', $params);
        return $this;
    }

    public function search($params)
    {
        $this->response = $this->client->post('/payment/SearchCard.idPass', $params);
        return $this;
    }

    public function delete($params)
    {
        $this->response = $this->client->post('/payment/DeleteCard.idPass', $params);
        return $this;
    }

}