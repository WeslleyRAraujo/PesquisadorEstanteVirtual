<?php

namespace WeslleyRAraujo\EstanteVirtual\Interfaces;

interface AdapterBase
{
    public function adapt(array $searchResult): array;
}