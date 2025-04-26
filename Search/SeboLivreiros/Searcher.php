<?php

namespace WeslleyRAraujo\EstanteVirtual\Search\SeboLivreiros;

use WeslleyRAraujo\EstanteVirtual\Search\Parser;
use WeslleyRAraujo\EstanteVirtual\Reflection\ReflectProperties;
use WeslleyRAraujo\EstanteVirtual\Search\Attributes\SeboLivreiros;
use WeslleyRAraujo\EstanteVirtual\Search\DefaultSearchProperties;

class Searcher
{
    use DefaultSearchProperties;

    public function search(): array
    {
        $this->checkParams();
        return $this->searchService();
    }

    private function searchService(): array
    {
        if (!isset($_ENV['test_estante_virtual']) || $_ENV['test_estante_virtual'] != true) {
            $Service = new Service();
            ReflectProperties::reflect($this, $Service, SeboLivreiros::class);

            $pageHtml = $Service->run();

            $Parser = new Parser();
            $seboLivreirosData = $Parser->parse($pageHtml);
        } else {
            $seboLivreirosData = json_decode(
                file_get_contents(__DIR__ . '/../Tests/sebo-livreiros-mock.json'),
                true
            );
        }

        if (!$seboLivreirosData) {
            throw new \Exception(json_last_error_msg());
        }

        $Adapter = new Adapter();
        $Adapter->setPage($this->page);
        return $Adapter->adapt($seboLivreirosData);
    }

    private function checkParams(): void
    {
        if (empty($this->name)) {
            throw new \Exception('undefined name');
        }

        if (empty($this->sellerId)) {
            throw new \Exception('undefined seller id');
        }
    }
}