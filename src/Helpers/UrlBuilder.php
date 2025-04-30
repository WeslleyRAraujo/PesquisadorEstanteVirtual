<?php

namespace WeslleyRAraujo\EstanteVirtual\Helpers;

use WeslleyRAraujo\EstanteVirtual\Search\DefaultSearchProperties;

class UrlBuilder
{
    use DefaultSearchProperties;

    private string $baseUrl;
    
    private array $queryParams = [];

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function buildUrl(): string
    {
        $queryParamsString = '';
        $queryParamsTranslated = $this->getQueryParamsTranslated();
        if (!empty($queryParamsTranslated)) {
            $queryParamsString = '?' . http_build_query($queryParamsTranslated);
        }
        return $this->baseUrl . $queryParamsString;
    }

    public function setQueryParams(array $queryParams): void
    {
        $this->queryParams = $queryParams;
    }

    private function getQueryParamsTranslated(): array
    {
        $queryParams = $this->queryParams;
        if (!empty($this->searchType)) {
            $queryParams['searchField'] = $this->searchType;
        }
        if (!empty($this->page)) {
            $queryParams['page'] = $this->page;
        }
        if (!empty($this->category)) {
            $queryParams['categoria'] = $this->category;
        }
        if (!empty($this->query)) {
            $queryParams['q'] = $this->query;
        }
        if (!empty($this->sort)) {
            $queryParams['sort'] = $this->sort;
        }
        if (!empty($this->language)) {
            $queryParams['idioma'] = $this->language;
        }
        if (!empty($this->publisher)) {
            $queryParams['editora'] = $this->publisher;
        }
        if (!empty($this->bookCondition)) {
            $queryParams['tipo-de-livro'] = $this->bookCondition;
        }
        if (!empty($this->priceFrom) && !empty($this->priceTo)) {
            $queryParams['_preco'] =  ($this->priceFrom * 100) . '-' . ($this->priceTo * 100);
        }
        if (!empty($this->author)) {
            $queryParams['autor'] = $this->autor;
        }
        if (!empty($this->yearOfPublication)) {
            $queryParams['ano-de-publicacao'] = $this->yearOfPublication;
        }
        if (!empty($this->city)) {
            $queryParams['cidade'] = $this->city;
        }
        if (!empty($this->sebosELivreiros)) {
            $queryParams['sebos-e-livreiros'] = $this->sebosELivreiros;
        }
        if (!empty($this->promotions)) {
            $queryParams['promocoes'] = $this->promotions;
        }
        if (!empty($this->ratings)) {
            $queryParams['_avaliacao'] = $this->ratings;
        }
        if (is_bool($this->corporatePurchasing)) {
            $queryParams['compra-corporativa'] = $this->corporatePurchasing ? 'sim' : 'nao';
        }
        return $queryParams;
    }
}