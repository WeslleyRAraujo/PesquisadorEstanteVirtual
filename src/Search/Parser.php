<?php

namespace WeslleyRAraujo\EstanteVirtual\Search;

use WeslleyRAraujo\EstanteVirtual\Interfaces\ParserBase;

class Parser implements ParserBase
{
    public function parse(string $searchResult): array
    {
        $html = $searchResult;
        $startPos = strpos($html, SearchRules::START_TAG);

        if ($startPos === false) {
            throw new \Exception("Start tag don't found");
        }

        $startPos += strlen(SearchRules::START_TAG);
        $endPos = strpos($html, SearchRules::END_TAG, $startPos);
        if ($endPos === false) {
            throw new \Exception("End tag don't found");
        }

        $jsonContent = substr($html, $startPos, $endPos - $startPos);
        
        $data = json_decode(trim($jsonContent), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON: ' . json_last_error_msg());
        }

        return $data;
    }
}