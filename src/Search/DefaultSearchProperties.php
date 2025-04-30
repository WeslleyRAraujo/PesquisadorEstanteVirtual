<?php

namespace WeslleyRAraujo\EstanteVirtual\Search;

use WeslleyRAraujo\EstanteVirtual\Reflection\Reflect;
use WeslleyRAraujo\EstanteVirtual\Search\Attributes\Busca;
use WeslleyRAraujo\EstanteVirtual\SearchTypes\SearchTypes;
use WeslleyRAraujo\EstanteVirtual\Search\Attributes\SeboLivreiros;

trait DefaultSearchProperties
{    
    #[Reflect]
    #[Busca]
    private ?string $author = null;

    #[Reflect]
    #[Busca]
    #[SeboLivreiros]
    private ?string $bookCondition = null;

    #[Reflect]
    #[Busca]
    #[SeboLivreiros]
    private ?string $category = null;

    #[Reflect]
    #[Busca]
    private ?string $city = null;

    #[Reflect]
    #[Busca]
    private ?bool $corporatePurchasing = null;

    #[Reflect]
    #[Busca]
    #[SeboLivreiros]
    private ?string $language = null;

    #[Reflect]
    #[SeboLivreiros]
    private ?string $name = null;

    #[Reflect]
    #[Busca]
    private ?int $page = null;

    #[Reflect]
    #[Busca]
    #[SeboLivreiros]
    private int|float $priceFrom = 0;

    #[Reflect]
    #[Busca]
    #[SeboLivreiros]
    private int|float $priceTo = 0;

    #[Reflect]
    #[Busca]
    private array $promotions = [];
    
    #[Reflect]
    #[Busca]
    #[SeboLivreiros]
    private ?string $publisher = null;

    #[Reflect]
    #[Busca]
    #[SeboLivreiros]
    private ?string $query = null;

    #[Reflect]
    #[Busca]
    private array $ratings = [];

    #[Reflect]
    #[Busca]
    private ?string $sebosELivreiros = null;

    #[Reflect]
    #[Busca]
    #[SeboLivreiros]
    private string $searchType = SearchTypes::TITULO_OU_AUTOR;

    #[Reflect]
    #[SeboLivreiros]
    private ?int $sellerId = null;

    #[Reflect]
    #[Busca]
    private ?string $sort = null;

    #[Reflect]
    #[Busca]
    #[SeboLivreiros]
    private ?int $yearOfPublication = null;
        
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    public function setSellerId(?int $sellerId): void
    {
        $this->sellerId = $sellerId;
    }

    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    public function setQuery(?string $query): void
    {
        $this->query = $query;
    }

    public function setSort(?string $sort): void
    {
        $this->sort = $sort;
    }
    
    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function setPublisher(?string $publisher): void
    {
        $this->publisher = $publisher;
    }

    public function setBookCondition(?string $bookCondition): void
    {
        $this->bookCondition = $bookCondition;
    }

    public function setPrice(float|int $priceFrom, float|int $priceTo): void
    {
        $this->priceTo = $priceTo;
        $this->priceFrom = $priceFrom;
    }

    public function setPriceTo(float|int $priceTo): void
    {
        $this->priceTo = $priceTo;
    }

    public function setPriceFrom(float|int $priceFrom): void
    {
        $this->priceFrom = $priceFrom;
    }

    public function setSearchType(string $searchType): void
    {
        $this->searchType = $searchType;
    }

    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    public function setYearOfPublication(?int $yearOfPublication): void
    {
        $this->yearOfPublication = $yearOfPublication;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function setSebosELivreiros(?string $sebosELivreiros): void
    {
        $this->sebosELivreiros = $sebosELivreiros;
    }

    /**
     * @param string[] $promotions
     */
    public function setPromotions(array $promotions): void
    {
        $this->promotions = $promotions;
    }

    /**
     * @param string[] $promotions
     */
    public function setRatings(array $ratings): void
    {
        $this->ratings = [];
    }

    public function setCorporatePurchasing(?bool $corporatePurchasing): void
    {
        $this->corporatePurchasing = $corporatePurchasing;
    }

    public function setBookId(?string $bookId): void
    {
        $this->bookId = $bookId;
    }
}