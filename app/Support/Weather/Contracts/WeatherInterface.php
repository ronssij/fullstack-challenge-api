<?php

namespace App\Support\Weather\Contracts;

interface WeatherInterface
{
    public function current($user = null): mixed;

    public function forecast($search = null, $parameters = []): mixed;
}
