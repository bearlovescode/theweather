<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Theweather\Helpers\Temperature;

    class CurrentWeather
    {
        public string $description = '';

        public float $tempC = 0.0;
        public float $tempF = 32.0;

        public float $dewpointC = 0.0;
        public float $dewpointF = 0.0;

        public float $heatIndexC = 0.0;
        public float $heatIndexF = 32.0;


        public function __construct(mixed $weatherData = null)
        {
            if ($weatherData) {
                $this->hydrate($weatherData);
            }
        }


        private function hydrate(mixed $data = null): void
        {

            $this->description = $data->textDescription;


            // Celsius
            $this->tempC = $data->temperature->value;
            $this->dewpointC = $data->dewpoint->value;
            $this->heatIndexC = $data->heatIndex->value;

            // Fahrenheit
            $this->tempF = Temperature::C2F($data->temperature->value);
            $this->dewpointF = Temperature::C2F($data->temperature->value);
            $this->heatIndexF = Temperature::C2F($data->temperature->value);
        }

        public function __toString(): string
        {
            return sprintf('Current Weather: %s, %f degF/ %f degC', $this->description, $this->tempF, $this->tempC);
        }
    }