<?php

namespace WeslleyRAraujo\EstanteVirtual\Interfaces;

interface ParserBase
{
    public function parse(string $searchResult): array;
}