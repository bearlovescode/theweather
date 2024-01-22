<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Datamodels\DataModel;

    class Elevation extends DataModel
    {
        public string $unitCode;
        public float $value;
    }