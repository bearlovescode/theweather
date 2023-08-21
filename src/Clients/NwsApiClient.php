<?php
    namespace Bearlovescode\Theweather\Clients;

    use GuzzleHttp\Client;
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

        public function observations(string $stationId)
        {

            try {
                $res = $this->client->request('GET',
                    sprintf('/stations/%s/observations/latest', $stationId));


                dd($res);

            }

            catch (NotFoundExceptionInterface $e)
            {

            }



        }
    }