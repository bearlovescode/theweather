<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Datamodels\DataModel;

    class Location extends DataModel
    {
        public float $lat = 0.0;
        public float $lon = 0.0;
    }