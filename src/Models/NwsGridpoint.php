<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Datamodels\DataModel;
    use GuzzleHttp\Psr7\Uri;

    class NwsGridpoint extends DataModel
    {
        public string $id;
        public string $type;
        public string $cwa;

        // property: gridId;
        public string $grid;

        // property: timeZone;
        public string $tz;

        // property: forecastOffice
        public Uri $office;

        // property: gridX
        public int $x;
        // property: gridY
        public int $y;

        public Uri $forecast;
        public Uri $forecastZone;
        public Uri $fireWeatherZone;
        public Uri $county;

        // property: forecastGridData
        public Uri $hourlyForecast;

        // property: forecastGridData
        public Uri $gridData;

        // property: observationStations
        public Uri $stations;


        // property: radarStation
        public string $radar;

        protected function hydrate(mixed $data): void
        {

            if (method_exists($data, 'getProperties'))
            {
                $props = $data->getProperties();

                $this->id = $props['@id'];
                $this->type = $props['@type'];
                $this->grid = $props['gridId'];
                $this->cwa = $props['cwa'];
                $this->office = new Uri($props['forecastOffice']);
                $this->tz = $props['timeZone'];
                $this->x = (int) $props['gridX'];
                $this->y = (int) $props['gridY'];
                $this->forecast = new Uri($props['forecast']);
                $this->hourlyForecast = new Uri($props['forecastHourly']);
                $this->forecastZone = new Uri($props['forecastZone']);
                $this->county = new Uri($props['county']);
                $this->fireWeatherZone = new Uri($props['fireWeatherZone']);
                $this->radar = $props['radarStation'];

            }



        }

    }