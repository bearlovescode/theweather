<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Theweather\Helpers\Temperature;

    class Weather
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
            if (method_exists($data, 'getProperties'))
            {
                $props = $data->getProperties();

                $this->description = $props['textDescription'];

                // Celsius
                $this->tempC = (float)$props['temperature']->value;
                $this->dewpointC = (float)$props['dewpoint']->value;
                $this->heatIndexC = (float)$props['heatIndex']->value;

                // Fahrenheit
                $this->tempF = Temperature::C2F($this->tempC);
                $this->dewpointF = Temperature::C2F($this->dewpointC);
                $this->heatIndexF = Temperature::C2F($this->heatIndexC);
            }
        }

        public function __toString(): string
        {
            return sprintf('Weather: %s, %s degF/ %s degC', $this->description,
                round($this->tempF, 0), round($this->tempC, 0));
        }
    }