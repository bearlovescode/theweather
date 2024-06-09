<?php
    namespace Bearlovescode\Theweather\Providers;

    use Bearlovescode\Theweather\Clients\NwsApiClient;
    use Bearlovescode\Theweather\Models\WeatherConfiguration;
    use Bearlovescode\Theweather\Services\NwsWeatherService;
    use Illuminate\Support\ServiceProvider;

    class WeatherServiceProvider extends ServiceProvider
    {
        public function boot() {
            $this->publishes([
                __DIR__ . '/../../config/weather.php' => config_path('weather.php')
            ]);
        }

        public function register() {

            $this->setUpNwsServices();
        }

        private function setUpNwsServices(): void
        {
            $this->app->singleton(NwsWeatherService::class, function () {
                $config = new WeatherConfiguration();
                $client = new NwsApiClient([
                    'agent' => env('APP_AGENT_NAME', env('APP_NAME')),
                    'contact' => env('APP_CONTACT_EMAIL')
                ]);
                return new NwsWeatherService($client, $config);
            });
        }
    }