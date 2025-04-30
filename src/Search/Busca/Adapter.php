<?php

namespace WeslleyRAraujo\EstanteVirtual\Search\Busca;

use WeslleyRAraujo\EstanteVirtual\Interfaces\AdapterBase;

class Adapter implements AdapterBase
{
    private const SALE_FACTOR = 100;

    private ?int $page = null;

    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    public function adapt(array $searchResult): array
    {        
        $totalPages = $searchResult['SearchPage']['totalPages'];

        $items = array_map(function ($item) {
            $code = $item['code'];
            $name = $item['name'];
            
            $description = $item['description'];
            $department = $item['department'] ?? null;
            $brand = $item['brand'] ?? null;
            $gender = $item['gender'] ?? null;
            $attributes = $item['attributes'];
            $productType = $item['productType'] ?? null;
            $price = floatval($item['salePrice'] / self::SALE_FACTOR);
            $discountPrice = floatval($item['discountPrice'] / self::SALE_FACTOR);
            $attributesMap = [];
            foreach ($attributes as $attribute) {
                $attributesMap[$attribute['name']] = $attribute['value'];
            }

            return [
                'code' => $code,
                'name' => $name,
                'description' => $description, 
                'department' => $department, 
                'brand' => $brand, 
                'gender' => $gender, 
                'attributes' => $attributes, 
                'productType' => $productType, 
                'price' => $price,
                'discountPrice' => $discountPrice
            ];
        }, $searchResult['SearchPage']['parentSkus']);

        return [
            'page' => $this->page?:1,
            'totalPages' => $totalPages,
            'items' => $items
        ];
    }
}