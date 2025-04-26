<?php

namespace WeslleyRAraujo\EstanteVirtual\Search\SeboLivreiros;

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
        $sellerInfo = $searchResult['Seller'];
        $sellerProducts = $searchResult['SellerProducts'];
        $distributionAddress = $sellerInfo['distributionAddress'];
        $contacts = $sellerInfo['contacts'];
        $percentRecommended = $searchResult['Reviews']['snapshot']['percentRecommended'];
        $totalItems = $sellerProducts['total'];
        $memberSince = (new \DateTime($sellerInfo['startDate']))->format('Y-m-d');
        $totalPages = $sellerProducts['totalPages'];

        $seller = [
            'name' => $sellerInfo['name'],
            'description' => $sellerInfo['description'],
            'distributionAddress' => $distributionAddress,
            'active' => $sellerInfo['active'],
            'contacts' => $contacts,
            'percentRecommended' => $percentRecommended,
            'totalItems' => $totalItems,
            'memberSince' => $memberSince
        ];
        
        $items = array_map(function ($item) {
            $id = $item['skuCode'];
            $name = $item['name'];
            $description = $item['description'];
            $department = $item['department'];
            $brand = $item['brand'];
            $gender = $item['gender'];
            $attributes = $item['attributes'];
            $productType = $item['productType'];
            $price = floatval($item['salePrice'] / self::SALE_FACTOR);
            $discountPrice = floatval($item['discountPrice'] / self::SALE_FACTOR);
            $attributesMap = [];
            foreach ($attributes as $attribute) {
                $attributesMap[$attribute['name']] = $attribute['value'];
            }
            return [
                'id' => $id,
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
        }, $sellerProducts['parentSkus']);

        return [
            'seller' => $seller,
            'page' => $this->page?:1,
            'totalPages' => $totalPages,
            'items' => $items
        ];
    }
}