<?php

class RecurringTest extends TestCase
{
    /** @var  \Settlement\GMO\Payment\Gateway\Requests\Recurring */
    protected $request;

    /** @var DateTime */
    protected static $tomorrow;

    protected static $recurringID;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $date = new DateTime();
        static::$tomorrow = $date->add(new DateInterval('P1D'));
        static::$recurringID = $date->getTimestamp();

    }

    public function setup()
    {
        $this->request = new \Settlement\GMO\Payment\Gateway\Requests\Recurring(static::$client);
    }
    public function testCreate()
    {
        $params = static::shopCredential();
        $params['RecurringID'] = static::$recurringID;
        $params['Amount'] = 5000;
        $params['Tax'] = 400;
        $params['ChargeDay'] = '01';
        $params['ChargeStartDate'] = static::$tomorrow->format('Ymd');
        $params['RegistType'] = '1';
        $params += static::siteCredential();
        $params['MemberID'] = getenv('EXISTS_MEMBER_ID');
        $params['ClientField1'] = 'test';

        $response = $this->request->create($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }

    public function testSearch()
    {
        $params = static::shopCredential();
        $params['RecurringID'] = '20170303121245';

        $response = $this->request->search($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }

    public function testUpdate()
    {
        $params = static::shopCredential();
        $params['RecurringID'] = '20170303121245';
        $params['Amount'] = 5400;
        $params['Tax'] = 0;

        $response = $this->request->update($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }

    public function testDelete()
    {
        $params = static::shopCredential();
        $params['RecurringID'] = static::$recurringID;

        $response = $this->request->delete($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }
}