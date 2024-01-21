<?php
    namespace Bearlovescode\Theweather\Services;

    use Bearlovescode\Theweather\Clients\NwsApiClient;
    use Bearlovescode\Theweather\Models\CurrentWeather;
    use Bearlovescode\Theweather\Models\Forecast;
    use Bearlovescode\Theweather\Models\WeatherConfiguration;

    class NwsWeatherService implements IWeatherService
    {

        private NwsApiClient $api;
        private WeatherConfiguration $config;

        public function __construct(NwsApiClient $apiClient, WeatherConfiguration $config)
        {
            $this->config = $config;
            $this->api = $apiClient;
        }

        public function getObservation() : CurrentWeather
        {
            $res = $this->api->observation(config('weather.station'));

            return new CurrentWeather($res);
        }

        public function getForecast() : Forecast
        {
            $res = $this->api->forecast($this->config->stationId);
            return new Forecast();

        }
    }