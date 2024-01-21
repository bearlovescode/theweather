<?php
    namespace Bearlovescode\Theweather\Services;

    use Bearlovescode\Theweather\Clients\NwsApiClient;
    use Bearlovescode\Theweather\Models\CurrentWeather;
    use Bearlovescode\Theweather\Models\Forecast;

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

        public function getForecast(string $stationId) : Forecast
        {
            return new Forecast();

        }
    }