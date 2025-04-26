# Pesquisador - Estante Virtual
![](https://img.shields.io/badge/PHP-8-green)

Esse projeto tem por objetivo facilitar a busca de livros na plataforma Estante Virtual, a partir das informações fornecidas é possível:
- Pesquisar livros de um sebo específico
- Buscar livros livremente pela plataforma para fins de pesquisa ou comparação de preço
---
## Exemplos de uso

### Para pesquisar os livros e as informações de um Sebo ou Livraria:
```php
$Searcher = new WeslleyRAraujo\EstanteVirtual\Search\SeboLivreiros\Searcher();

// Seller id e name são obrigatórios
$Searcher->setSellerId($sellerId);
$Searcher->setName($name);
$Searcher->setPage($page);
$Searcher->setCategory($category);

$books = $Searcher->search();

var_dump($books);
```

##### Onde eu consigo o seller ID e o name?
Aqui está um exemplo de onde conseguir essas informações:
[foto aqui]
O name faz parte da rota e o seller ID é o parâmetro *sellerId* da URL

### Para pesquisa livre:
```php
$Searcher = new WeslleyRAraujo\EstanteVirtual\Search\Busca\Searcher();

$Searcher->setQuery('Machado de Assis'); 
 // Filtro de pesquisa por autor
$Searcher->setSearchType(WeslleyRAraujo\EstanteVirtual\SearchTypes\SearchTypes::AUTOR);

$result = $Searcher->search();

var_dump($result);
```

### Filtros padrão do site

Todos os fitros das páginas de busca ou sebo-livreiros estão disponíveis e podem ser consultados no arquivo: **Search/DefaultSearchProperties.php**, os atributos definidos a cada um mostra qual filtro está disponível, há filtros como **Condição do livro [bookCondition]** que existem em ambas as buscas mas outros estão disponíveis apenas para pesquisa livre ou por sebo/livraria.
[foto_dos_filtros_aqui]

---
## Dicas
- Se na utilização da classe **WeslleyRAraujo\EstanteVirtual\Search\Busca\Searcher** os dados **brand, department, gender e productType** dos itens forem essenciais faça a pesquisa duas vezes, por algum motivo na primeira requisição a estante virtual não retorna esses dados mas na segunda requisição eles aparecem, provavelmente é algo relacionado ao cache da página.

---
## Mais
Encontrou algum bug? Abra uma issue!
Quer contribuir? Solicite uma pull request!