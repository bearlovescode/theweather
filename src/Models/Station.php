<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Datamodels\Dto\Dto;
    use GuzzleHttp\Psr7\Uri;
    use http\Url;

    class Station extends Dto
    {
        public string $identifier = '';
        public string $name = '';
        public string $tz = 'UTC';
        public Uri $forecast;
        public Uri $county;
        public Uri $fireWeatherZone;


        public function hydrate(mixed $data): void
        {
            if (method_exists($data, 'getProperties'))
            {
                $props = $data->getProperties();

                $this->id = $props['@id'];
                $this->type = $props['@type'];
                $this->tz = $props['timeZone'];
                $this->elevation = new Elevation($props['elevation']);
                $this->forecast = new Uri($props['forecast']);
                $this->county = new Uri($props['county']);
                $this->fireWeatherZone = new Uri($props['fireWeatherZone']);
            }

        }
    }