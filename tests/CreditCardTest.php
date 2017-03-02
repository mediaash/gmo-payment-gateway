<?php

class CreditCardTest extends TestCase
{
    public function testInsert()
    {
        $params = self::siteCredential();
        $params['MemberID'] = getenv('EXISTS_MEMBER_ID');
        $params['CardNo'] = '4111111111111111';
        $params['Expire'] = '1901';
        $params['HolderName'] = 'HOGE FUGA';

        $card = new \Settlement\GMO\Payment\Gateway\Requests\CreditCard(self::$client);
        $response = $card->insert($params)->response();

        self::$client->CardSeq = $response->CardSeq;
        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }

    public function testUpdate()
    {
        $params = self::siteCredential();
        $params['MemberID'] = getenv('EXISTS_MEMBER_ID');
        $params['CardSeq'] = 0;
        $params['DefaultFlag'] = 1;
        $params['CardNo'] = '4111111111111111';
        $params['Expire'] = '1901';
        $params['CardName'] = 'VISA';

        $card = new \Settlement\GMO\Payment\Gateway\Requests\CreditCard(self::$client);
        $response = $card->update($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }

    public function testSearch()
    {
        $params = self::siteCredential();
        $params['MemberID'] = getenv('EXISTS_MEMBER_ID');
        $params['SeqMode'] = 0;

        $card = new \Settlement\GMO\Payment\Gateway\Requests\CreditCard(self::$client);
        $response = $card->search($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }

    public function testDelete()
    {
        $params = self::siteCredential();
        $params['MemberID'] = getenv('EXISTS_MEMBER_ID');
        $params['SeqMode'] = 0;

        $card = new \Settlement\GMO\Payment\Gateway\Requests\CreditCard(self::$client);

        $response = $card->search($params)->response();
        $cardSeq = explode('|', $response->CardSeq);
        $params['CardSeq'] = array_pop($cardSeq);
        $response = $card->delete($params)->response();

        $this->assertEmpty($response->errors(), json_encode($response->errors()));
    }
}