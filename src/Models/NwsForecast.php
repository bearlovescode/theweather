<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Datamodels\DataModel;
    use Carbon\Carbon;
    use GuzzleHttp\Psr7\Uri;

    class NwsForecast extends DataModel
    {
        public Carbon $updated;
        public string $units;

        // property: forecastGenerator;
        public string $generator;
        public Carbon $generatedAt;
        public Carbon $updateTime;

        public array $periods = [];

        protected function hydrate(mixed $data): void
        {
            if (method_exists($data, 'getProperties'))
            {
                $props = $data->getProperties();
                $this->updated = new Carbon($props['updated']);
                $this->units = $props['units'];
                $this->generator = $props['forecastGenerator'];
                $this->generatedAt = new Carbon($props['generatedAt']);
                $this->updateTime = new Carbon($props['updateTime']);


                if (count($props['periods']) > 0)
                    foreach($props['periods'] as $period)
                        $this->periods[] = new NwsForecastPeriod($period);
            }
        }

    }