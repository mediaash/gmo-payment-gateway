<?php
namespace Settlement\GMO\Payment\Gateway\Requests;

/**
 * Class Customer
 * @package Settlement\GMO\Payment\Gateway\Requests
 */
class Customer extends Request
{
    public function create(array $params)
    {
        $this->response = $this->client->post('/payment/SaveMember.idPass', $params);
        return $this;
    }

    public function update(array $params)
    {
        $this->response = $this->client->post('/payment/UpdateMember.idPass', $params);
        return $this;

    }

    public function search(array $params)
    {
        $this->response = $this->client->post('/payment/SearchMember.idPass', $params);
        return $this;

    }

    public function delete(array $params)
    {
        $this->response = $this->client->post('/payment/DeleteMember.idPass', $params);
        return $this;

    }
}