<?php
class TransactionTest extends TestCase
{
    protected $orderId;

    /** @var \Settlement\GMO\Payment\Gateway\Requests\Transaction */
    public $request;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

    }

    public function setUp()
    {
        $this->request = new \Settlement\GMO\Payment\Gateway\Requests\Transaction(static::$client);
        $this->orderId = str_replace('.', '', microtime(true));
    }

    public function testCreate()
    {
        $params = static::shopCredential();
        $params['OrderID'] = $this->orderId;
        $params['JobCd'] = 'CAPTURE';
        $params['Amount'] = 5000;
        $params['Tax'] = 400;

        $response = $this->request->create($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));

        $this->assertArrayHasKey('AccessID', $response, json_encode($response));
        $this->assertArrayHasKey('AccessPass', $response, json_encode($response));
    }

    public function testSearch()
    {
        $params = static::shopCredential();
        $params['OrderID'] = $this->orderId;
        $params['JobCd'] = 'CAPTURE';
        $params['Amount'] = 5000;
        $params['Tax'] = 400;
        $this->request->create($params)->response();

        $params = static::shopCredential();
        $params['OrderID'] = $this->orderId;

        $response = $this->request->search($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));

        $this->assertEquals($this->orderId, $response->OrderID, $response->OrderID);
    }

    public function testExecute()
    {
        $params = static::shopCredential();
        $params['OrderID'] = $this->orderId;
        $params['JobCd'] = 'CAPTURE';
        $params['Amount'] = 5000;
        $params['Tax'] = 400;
        $response = $this->request->create($params)->response();

        $params = static::siteCredential();
        $params['AccessID'] = $response->AccessID;
        $params['AccessPass'] = $response->AccessPass;
        $params['OrderID'] = $this->orderId;
        $params['Method'] = 1;
        $params['MemberID'] = getenv('EXISTS_MEMBER_ID');
        $params['CardSeq'] = 1;

        $response = $this->request->execute($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }

    public function testUpdate()
    {
        $params = static::shopCredential();
        $params['OrderID'] = $this->orderId;
        $params['JobCd'] = 'CAPTURE';
        $params['Amount'] = 5000;
        $params['Tax'] = 400;
        $response = $this->request->create($params)->response();

        $params = static::siteCredential();
        $params['AccessID'] = $accessID = $response->AccessID;
        $params['AccessPass'] = $accessPass = $response->AccessPass;
        $params['OrderID'] = $this->orderId;
        $params['Method'] = 1;
        $params['MemberID'] = getenv('EXISTS_MEMBER_ID');
        $params['CardSeq'] = 1;

        $response = $this->request->execute($params)->response();

        $params = static::shopCredential();
        $params['AccessID'] = $accessID;
        $params['AccessPass'] = $accessPass;
        $params['JobCd'] = 'VOID';

        $response = $this->request->update($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }

    public function testChange()
    {
        $params = static::shopCredential();
        $params['OrderID'] = $this->orderId;
        $params['JobCd'] = 'CAPTURE';
        $params['Amount'] = 8000;
        $params['Tax'] = 640;
        $response = $this->request->create($params)->response();

        $params = static::siteCredential();
        $params['AccessID'] = $accessID = $response->AccessID;
        $params['AccessPass'] = $accessPass = $response->AccessPass;
        $params['OrderID'] = $this->orderId;
        $params['Method'] = 1;
        $params['MemberID'] = getenv('EXISTS_MEMBER_ID');
        $params['CardSeq'] = 1;

        $this->request->execute($params)->response();

        $params = static::shopCredential();
        $params['OrderID'] = $this->orderId;
        $params['JobCd'] = 'CAPTURE';
        $params['AccessID'] = $accessID;
        $params['AccessPass'] = $accessPass;
        $params['Amount'] = 4000;
        $params['Tax'] = 320;

        $response = $this->request->change($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }

}