<?php
    namespace Bearlovescode\Theweather\Services;

    use Bearlovescode\Theweather\Clients\NwsApiClient;
    use Bearlovescode\Theweather\Models\CurrentWeather;

    class NwsWeatherService implements IWeatherService
    {

        private NwsApiClient $api;

        public function __construct(NwsApiClient $apiClient)
        {
            $this->api = $apiClient;
        }

        public function getObservation() : CurrentWeather
        {
            $res = $this->api->observation(config('weather.station'));

            return new CurrentWeather($res);
        }
    }