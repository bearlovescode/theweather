<?php
    namespace Bearlovescode\Theweather\Services;

    use Bearlovescode\Theweather\Clients\NwsApiClient;

    class NwsWeatherService implements IWeatherService
    {

        private NwsApiClient $api;

        public function __construct(NwsApiClient $apiClient)
        {
            $this->api = $apiClient;
        }

        public function getObservations() : void
        {
            $res = $this->api->observations(config('weather.station'));
        }
    }