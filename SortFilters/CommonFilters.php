<?php

namespace WeslleyRAraujo\EstanteVirtual\SortFilters;

class CommonFilters
{
    /**
     * Relevância
     */
    public const RELEVANCE = 'relevance';

    /**
     * Menor preço do livro
     */
    public const LOWEST_FIRST = 'lowest-first';

    /**
     * Maior preço do livro
     */
    public const HIGHEST_FIRST = 'highest-first';

    /**
     * Ultimos cadastrados
     */
    public const NEW_RELEASES = 'new-releases';
    
    /**
     * Mais vendidos
     */
    public const BEST_SELLERS = 'best-sellers';
}