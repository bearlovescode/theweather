<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Datamodels\Dto\Dto;
    use http\Url;

    class Station extends Dto
    {
        public string $identifier = '';
        public string $name = '';
        public string $tz = 'UTC';
        public Url $forecast;
        public Url $county;
        public Url $fireWeatherZone;


        public function hydrate(mixed $data): void
        {
            switch(gettype($data)) {
                case 'object':
                    break;

                default:

            }

            parent::hydrate($data);
        }
    }