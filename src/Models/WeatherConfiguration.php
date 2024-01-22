<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Datamodels\DataModel;

    class WeatherConfiguration extends DataModel
    {
        public ?string $stationId;
        public ?string $zoneId;
        public ?Location $location;
    }