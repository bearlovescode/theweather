<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Theweather\Helpers\Temperature;

    class CurrentWeather
    {
        public string $description = '';

        public float $tempC = 0.0;
        public float $minTempC = 0.0;
        public float $maxTempC = 100.0;


        public float $tempF = 32.0;
        public float $minTempF = 32.0;
        public float $maxTempF = 212.0;

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
            if (method_exists($data, 'getProperties'))
            {
                $props = $data->getProperties();

                $this->description = $props['textDescription'];

                // Celsius
                $this->tempC = (float)$props['temperature']->value;
                $this->minTempC = (float)$props['minTemperatureLast24Hours']->value;
                $this->maxTempC = (float)$props['maxTemperatureLast24Hours']->value;

                $this->dewpointC = (float)$props['dewpoint']->value;
                $this->heatIndexC = (float)$props['heatIndex']->value;

                // Fahrenheit
                $this->tempF = Temperature::C2F($this->tempC);
                $this->minTempF = Temperature::C2F($this->minTempC);
                $this->maxTempF = Temperature::C2F($this->maxTempC);
                $this->dewpointF = Temperature::C2F($this->dewpointC);
                $this->heatIndexF = Temperature::C2F($this->heatIndexC);
            }
        }

        public function __toString(): string
        {
            return sprintf('Current Weather: %s, %s degF/ %s degC', $this->description,
                round($this->tempF, 0), round($this->tempC, 0));
        }
    }