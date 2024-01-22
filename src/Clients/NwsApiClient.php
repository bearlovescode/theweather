<?php
    namespace Bearlovescode\Theweather\Clients;

    use GeoJson\GeoJson;
    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\ClientException;
    use Psr\Container\NotFoundExceptionInterface;

    class NwsApiClient
    {
        public function __construct(array $options = [])
        {

            $this->client = new Client([
                'base_uri' => 'https://api.weather.gov',
                'headers' => [
                    'User-Agent' => sprintf('(%s %s)', $options['agent'], $options['contact']),
                    'Accept' => 'application/json+ld'
                ]
            ]);
        }

        public function observation(string $stationId)
        {

            try {
                $res = $this->client->request('GET',
                    sprintf('/stations/%s/observations/latest', $stationId));

                $data = $res->getBody()->getContents();

                return GeoJson::jsonUnserialize(json_decode($data));

            }

            catch (ClientException $e)
            {

            }
        }

        public function forecast(string $stationId)
        {

        }

        public function stations()
        {
            $res = $this->client->request('GET',
                sprintf('/stations/'));

            $data = $res->getBody()->getContents();

            return GeoJson::jsonUnserialize(json_decode($data));
        }
    }