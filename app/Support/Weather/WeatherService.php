<?php

namespace App\Support\Weather;

use App\Support\Weather\Contracts\WeatherInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class WeatherService implements WeatherInterface
{
    protected $apiUrl;
    protected $apiKey;
    protected $client;

    public function __construct()
    {
        $this->apiUrl  = config('weather.api.url');
        $this->apiKey  = config('weather.api.key');

        $this->client = Http::withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Weather API Current search.
     *
     * @param string $search
     * @return mixed
     */
    public function current($search = null): mixed
    {
        $instance = (new static);

        $response = $instance->client->get($instance->apiUrl . '/current.json', [
            'key' => $instance->apiKey,
            'q'   => $search
        ]);

        if ($response->successful()) {
            return JsonResource::make(json_decode($response->body()));
        }

        return $response->throw();
    }

    /**
     * Weather API Forecast search.
     *
     * @param string $search
     * @param array $parameters
     * @return Http
     */
    public function forecast($search = null, $parameters = []): mixed
    {
        $instance = (new static);

        $parameters = array_merge([
            'key' => $instance->apiKey,
            'q'   => $search
        ], $parameters);

        $response = $instance->client->get($instance->apiUrl . '/forecast.json', $parameters);

        if ($response->successful()) {
            return json_decode($response->body());
        }

        return $response->throw();
    }
}
