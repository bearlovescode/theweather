<?php
    namespace Bearlovescode\Theweather\Clients;

    use Bearlovescode\Theweather\Models\NwsForecast;
    use GeoJson\GeoJson;
    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\ClientException;
    use GuzzleHttp\Psr7\Uri;
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

        public function zoneForecast(string $zoneId) : object
        {
            try {
                $station = $this->station($zoneId);
            }

            catch (ClientException $e)
            {

            }
        }

        public function station(string $stationId) : object
        {
            $res = $this->client->request('GET',
                sprintf('/stations/%s', $stationId));

            $data = $res->getBody()->getContents();

            return GeoJson::jsonUnserialize(json_decode($data));
        }

        public function stations()
        {
            $res = $this->client->request('GET',
                sprintf('/stations/'));

            $data = $res->getBody()->getContents();

            return GeoJson::jsonUnserialize(json_decode($data));
        }

        public function gridpoint(float $x, float $y): GeoJson
        {
            return $this->getDataViaUri(new Uri(sprintf('/points/%s,%s', $x, $y)));
        }

        public function gridpointForecast(float $x, float $y) : GeoJson
        {
            $gp = $this->gridpoint($x, $y);


        }

        public function getDataViaUri(string|Uri $uri): GeoJson
        {
            $res = $this->client->request('GET', $uri);

            $data = $res->getBody()->getContents();

            return GeoJson::jsonUnserialize(json_decode($data));
        }
    }