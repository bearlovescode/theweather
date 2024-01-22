<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Datamodels\DataModel;
    use Carbon\Carbon;
    use GuzzleHttp\Psr7\Uri;

    class ForecastPeriod extends DataModel
    {
        public int $number;
        public string $name;
        public Uri $icon;

        // property: startTime;
        public Carbon $start;
        // property: endTime;
        public Carbon $end;
        public bool $isDaytime = false;
        // property: temperature
        public int $temp = 0;
        // property: temperatureUnit
        public string $unit;
        // property: temperatureTrend
        public string $trend;
        // property: dewpoint['value'];
        public float $dewpoint = 0.0;
        // property: relativeHumidity['value']
        public int $humidity;
        public string $windSpeed;
        public string $windDirection;
        // property: shortForecast
        public string $shortDescription;

        // property: detailedForecast;
        public string $description;



        protected function hydrate(mixed $data): void
        {
            $this->start = new Carbon($data->startTime);
            $this->end = new Carbon($data->endTime);
            $this->temp = (int) $data->temperature;
            $this->unit = $data->temperatureUnit;
            $this->trend = $data->temperatureTrend;
            $this->dewpoint = (float) $data->dewpoint->value;
            $this->humidity = (int) $data->humidity->value;
            $this->shortDescription = $data->shortForecast;
            $this->description = $data->detailedForecast;
            $this->icon = new Uri($data->icon);

            $customVars = [
                'startTime',
                'endTime',
                'temperature',
                'temperatureUnit',
                'temperatureTrend',
                'probabilityOfPrecipitation',
                'dewpoint',
                'relativeHumidity',
                'icon',
                'shortForecast',
                'detailedForecast',
            ];

            foreach ($customVars as $v)
                unset($data->$v);

            parent::hydrate($data);
        }

    }