<?php

namespace Quicktech\ExchangeRate\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * This file is part of Quicktech\ExchangeRate package,
 * a wrapper solution for Laravel to Exchange Rate API.
 *
 * @license MIT
 * @package Quicktech\ExchangeRate
 */
class ExchangeRate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'exchange_rate';
    }
}
