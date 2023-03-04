<?php

namespace App\Facades;

use App\Support\Weather\Contracts\WeatherInterface;
use Illuminate\Support\Facades\Facade;

class Weather extends Facade
{
/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return WeatherInterface::class;
    }
}
