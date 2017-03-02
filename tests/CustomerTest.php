<?php

class CustomerTest extends TestCase
{
    public function testCreate()
    {
        $params = self::siteCredential();
        $params['MemberID'] = self::$MemberID;

        $customer = new \Settlement\GMO\Payment\Gateway\Requests\Customer(static::$client);

        $response = $customer->create($params)->response();

        $this->assertEmpty($response->errors(), $response);
        $this->assertTrue($response->has('MemberID'), $response);
    }

    public function testUpdate()
    {
        $params = self::siteCredential();
        $params['MemberID'] = self::$MemberID;
        $params['MemberName'] = 'hoge';

        $customer = new \Settlement\GMO\Payment\Gateway\Requests\Customer(static::$client);

        $response = $customer->update($params)->response();

        $this->assertEmpty($response->errors(), $response);
        $this->assertTrue($response->has('MemberID'), $response);
    }

    public function testSearch()
    {
        $params = self::siteCredential();
        $params['MemberID'] = self::$MemberID;
        $params['MemberName'] = 'hoge';

        $customer = new \Settlement\GMO\Payment\Gateway\Requests\Customer(static::$client);

        $response = $customer->update($params)->response();

        $this->assertEmpty($response->errors(), $response);
        $this->assertTrue($response->has('MemberID'), $response);
    }

    public function testDelete()
    {
        $params = self::siteCredential();
        $params['MemberID'] = self::$MemberID;

        $customer = new \Settlement\GMO\Payment\Gateway\Requests\Customer(static::$client);

        $response = $customer->delete($params)->response();

        $this->assertEmpty($response->errors(), $response);
        $this->assertTrue($response->has('MemberID'), $response);
    }
}