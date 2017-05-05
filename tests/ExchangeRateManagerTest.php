<?php

namespace Quicktech\Test\ExchangeRate;

use PHPUnit\Framework\TestCase;
use Quicktech\ExchangeRate\ExchangeRateManager;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;

/**
 * ExchangeRateManagerTest class
 */
class ExchangeRateManagerTest extends TestCase
{
    /**
     * @var array
     */
    private $config = [];

    public function setUp()
    {
        $this->config = [
            'default_currency' => getenv('EXCHANGERATE_DEFAULT_CURRENCY'),
            'api_key' => getenv('EXCHANGERATE_API_KEY'),
            'api_uri' => getenv('EXCHANGERATE_API_URI'),
        ];
    }

    /**
     * @test
     */
    public function get_rates_based_on_default_currency_should_returns_as_array()
    {
        $bodyMock = '{
            "result": "success",
            "from": "USD",
            "rates": {
                "AUD": 1.32230,
                "BGN": 1.8096,
                "BRL": 3.11
            }
        }';

        $httpClient = $this->httpClientMock($bodyMock);

        $exchangerate = new ExchangeRateManager($this->config, $httpClient);
        $rates = $exchangerate->rates();

        $this->assertTrue(is_array($rates));
        $this->assertArrayHasKey('BRL', $rates);
    }

    /**
     * @test
     */
    public function invalid_http_client_should_returns_a_null()
    {
        $bodyMock = '{"result": "false"}';
        $httpClient = $this->httpClientMock($bodyMock);

        $exchangerate = new ExchangeRateManager($this->config, $httpClient);
        $rates = $exchangerate->rates();

        $this->assertNull($rates);
    }

    /**
     * @test
     */
    public function convert_value_based_on_from_currency_and_to_currency()
    {
        $bodyMock = '{ "result": "success", "from": "USD", "to": "BRL", "rate": 3.11 }';
        $httpClient = $this->httpClientMock($bodyMock);

        $exchangerate = new ExchangeRateManager($this->config, $httpClient);
        $value = $exchangerate->convert(2.00, 'USD', 'BRL');

        $this->assertEquals($value, 6.22);
    }

    /**
     * @return Client
     */
    private function httpClientMock($bodyMock = '')
    {
        $mock = new MockHandler([
            new Response(200, [], $bodyMock)
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        return $client;
    }
}