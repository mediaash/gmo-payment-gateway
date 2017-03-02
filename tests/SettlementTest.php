<?php
class SettlementTest extends TestCase
{
    /** @var \Settlement\GMO\Payment\Gateway\Settlement */
    public $settlement;

    public function setUp()
    {
        $this->settlement= new \Settlement\GMO\Payment\Gateway\Settlement(getenv('GMO_PAYMENT_API_BASE_URL'), ['timeout' => 10]);
    }

    /**
     * @param $expected
     * @param $request
     * @dataProvider requestDataProvider
     */
    public function testMake($expected, $request)
    {
        $actual = $this->settlement->make($request);

        $this->assertInstanceOf($expected, $actual, get_class($actual));
    }

    public function requestDataProvider()
    {
        return [
            [\Settlement\GMO\Payment\Gateway\Requests\CreditCard::class, 'CreditCard'],
            [\Settlement\GMO\Payment\Gateway\Requests\Customer::class, 'Customer'],
            [\Settlement\GMO\Payment\Gateway\Requests\Recurring::class, 'Recurring'],
            [\Settlement\GMO\Payment\Gateway\Requests\Transaction::class, 'Transaction'],
        ];
    }
}