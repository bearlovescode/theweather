<?php
    namespace Bearlovescode\Theweather\Models;

    use Bearlovescode\Datamodels\DataModel;
    use GuzzleHttp\Psr7\Uri;

    class NwsOffice extends DataModel
    {
        public string $id;
        public string $name;
        public string $tel;
        public string $email;
        public string $region;

        public function hydrate(mixed $data): void
        {
            if (method_exists($data, 'getProperties'))
            {
                $props = $data->getProperties();

                $this->id = $props['@id'];
                $this->type = $props['@type'];
                $this->name = $props['name'];
                $this->tel = $props['telephone'];
                $this->email = $props['email'];
                $this->region = $props['nwsRegion'];
            }

        }
    }