<?php

namespace WeslleyRAraujo\EstanteVirtual\Search\Busca;

use WeslleyRAraujo\EstanteVirtual\Search\Parser;
use WeslleyRAraujo\EstanteVirtual\Search\Attributes\Busca;
use WeslleyRAraujo\EstanteVirtual\Reflection\ReflectProperties;
use WeslleyRAraujo\EstanteVirtual\Search\DefaultSearchProperties;

class Searcher
{
    use DefaultSearchProperties;

    public function search(): array
    {
        return $this->searchService();
    }

    private function searchService(): array
    {
        if (!isset($_ENV['test_estante_virtual']) || $_ENV['test_estante_virtual'] != true) {
            $Service = new Service();
            ReflectProperties::reflect($this, $Service, Busca::class);

            $pageHtml = $Service->run();

            $Parser = new Parser();
            $buscaData = $Parser->parse($pageHtml);
        } else {
            $buscaData = json_decode(
                file_get_contents(__DIR__ . '/../Tests/busca-mock.json'),
                true
            );
        }

        if (!$buscaData) {
            throw new \Exception(json_last_error_msg());
        }

        $Adapter = new Adapter();
        $Adapter->setPage($this->page);
        return $Adapter->adapt($buscaData);
    }
}