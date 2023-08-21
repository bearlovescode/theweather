<?php
    namespace Bearlovescode\Theweather\Providers;

    use Bearlovescode\Theweather\Clients\NwsApiClient;
    use Bearlovescode\Theweather\Services\NwsWeatherService;
    use Illuminate\Support\ServiceProvider;

    class WeatherServiceProvider extends ServiceProvider
    {
        public function boot() {

        }

        public function register() {
            $this->app->singleton(NwsWeatherService::class, function () {
                return new NwsWeatherService(new NwsApiClient());
            });
        }
    }