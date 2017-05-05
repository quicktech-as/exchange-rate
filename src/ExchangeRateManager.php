<?php

namespace Quicktech\ExchangeRate;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

/**
 * This class is the main entry point of exchange rate package. Usually the interaction
 * with this class will be done through the ExchangeRate Facade
 *
 * @license MIT
 * @package Quicktech\ExchangeRate
 */
class ExchangeRateManager
{
    /**
     * Currency configuration.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Http client used to connect
     *
     * @var Client
     */
    private $httpClient;

    /**
     * Create a new confide instance.
     *
     * @param array  $config
     * @param Client $httpClient
     */
    public function __construct(array $config, Client $httpClient)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
    }

    /**
     * Get currency rates based on default currency
     *
     * @return array
     */
    public function rates()
    {
        $uri = sprintf('bulk/%s/%s', $this->config('api_key'), $this->config('default_currency'));

        $request = $this->httpClient->get($uri);
        $content = $request->getBody()->getContents();

        $response = json_decode($content);

        if ('success' === $response->result) {
            return (array) $response->rates;
        }

        return null;
    }

    /**
     * Format given number.
     *
     * @param float  $amount
     * @param string $from
     * @param string $to
     * @param bool   $format
     *
     * @return string
     */
    public function convert($amount, $from = null, $to = null)
    {
        $uri = sprintf('bulk/%s/%s/%s', $this->config('api_key'), $from, $to);

        $request = $this->httpClient->get($uri);
        $content = $request->getBody()->getContents();

        $response = json_decode($content);

        if ('success' === $response->result) {
            $value = ($amount * $response->rate);

            return $value;
        }

        return null;
    }

    /**
     * Get configuration value.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function config($key = null, $default = null)
    {
        if ($key === null) {
            return $this->config;
        }

        return Arr::get($this->config, $key, $default);
    }
}
