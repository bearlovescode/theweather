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
            $station = $data->properties;

            $this->id = $data->properties['@id'];
            $this->type = $data->properties['@type'];
            $this->tz = $data->properties['timeZone'];
            $this->elevation = new Elevation($data->properties['elevation']);
            $this->forecast = new Url($data->properties['forecast']);
            $this->county = new Url($data->properties['county']);
            $this->fireWeatherZone = new Url($data->properties['fireWeatherZone']);

            unset(
                $data->properties['@id'],
                $data->properties['@type'],
                $station['timeZone'],
                $station
            );

            parent::hydrate($data);
        }
    }