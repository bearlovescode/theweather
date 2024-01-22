<?php
    namespace Bearlovescode\Theweather\Services;

    use Bearlovescode\Theweather\Clients\NwsApiClient;
    use Bearlovescode\Theweather\Models\CurrentWeather;
    use Bearlovescode\Theweather\Models\Forecast;
    use Bearlovescode\Theweather\Models\Station;
    use Bearlovescode\Theweather\Models\WeatherConfiguration;
    use GuzzleHttp\Psr7\Uri;

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
            $res = $this->api->observation($this->config->stationId);

            return new CurrentWeather($res);
        }

        public function getForecast() : Forecast
        {
            $res = $this->api->forecast($this->config->stationId);
            return new Forecast();
        }

        public function getStationForecast(Station $station): mixed
        {
            $forecastUri = new Uri($station->forecast, 'forecast');
            $res = $this->api->getDataViaUri($forecastUri);
            return $res;
        }

        public function getStation() : Station
        {
            $res = $this->api->station($this->config->stationId);
            return new Station($res);
        }

    }