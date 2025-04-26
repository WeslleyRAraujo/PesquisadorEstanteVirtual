<?php

namespace WeslleyRAraujo\EstanteVirtual\Search\Busca;

use WeslleyRAraujo\EstanteVirtual\Helpers\UrlBuilder;
use WeslleyRAraujo\EstanteVirtual\Interfaces\ServiceBase;
use WeslleyRAraujo\EstanteVirtual\Reflection\ReflectProperties;
use WeslleyRAraujo\EstanteVirtual\Search\DefaultSearchProperties;

class Service implements ServiceBase
{
    use DefaultSearchProperties;

    private const BASE_URL = 'https://www.estantevirtual.com.br/busca';

    public function run(): string
    {
        return $this->service();
    }

    private function service(): string
    {
        $curl = curl_init();

        $UrlBuilder = new UrlBuilder(self::BASE_URL . $this->name);
        ReflectProperties::reflect($this, $UrlBuilder, Busca::class);

        curl_setopt_array(
            $curl, 
            [
                CURLOPT_URL => $UrlBuilder->buildUrl(),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ]
        );

        $response = curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            throw new \Exception("Estante Virtual HTTP Code: {$httpCode}");
        }

        curl_close($curl);

        return $response;
    }
}