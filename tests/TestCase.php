<?php
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /** @var \Settlement\GMO\Payment\Gateway\Client */
    protected static $client;

    /** @var string */
    protected static $SiteID;

    /** @var string */
    protected static $SitePass;

    /** @var string */
    protected static $ShopID;

    /** @var string */
    protected static $ShopPass;

    /** @var string */
    protected static $MemberID;

    protected static $existsMemberID = 'TEST_0DB9346A-FBE0-422F-A4C9-CC68DC2AEC9D';

    public static function setUpBeforeClass()
    {
        self::$MemberID = 'TEST_' . exec('uuidgen');
        static::$client = new \Settlement\GMO\Payment\Gateway\Client(getenv('GMO_PAYMENT_API_BASE_URL'), ['timeout' => 10]);
    }

    /**
     * @return array
     */
    protected static function shopCredential()
    {
        self::$ShopID = getenv('GMO_PAYMENT_SHOP_ID');
        self::$ShopPass = getenv('GMO_PAYMENT_SHOP_PASS');
        return [
            'ShopID' => self::$ShopID,
            'ShopPass' => self::$ShopPass,
        ];
    }

    /**
     * @return array
     */
    protected static function siteCredential()
    {
        self::$SiteID = getenv('GMO_PAYMENT_SITE_ID');
        self::$SitePass = getenv('GMO_PAYMENT_SITE_PASS');
        return [
            'SiteID' => self::$SiteID,
            'SitePass' => self::$SitePass,
        ];
    }
}
