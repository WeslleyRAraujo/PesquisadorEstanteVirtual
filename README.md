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
![2025-04-26_16-25](https://github.com/user-attachments/assets/93959fc3-32c2-4015-9d24-9108b628544e)
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
![image](https://github.com/user-attachments/assets/6ce71e2b-3bca-4e1e-8b48-f3fccc46ca12)

---
## Dicas
- Se na utilização da classe **WeslleyRAraujo\EstanteVirtual\Search\Busca\Searcher** se os dados **brand, department, gender e productType** dos itens forem essenciais faça a pesquisa duas vezes, por algum motivo na primeira requisição a estante virtual não retorna esses dados mas na segunda requisição eles aparecem, provavelmente é algo relacionado ao cache da página.

---
## Mais
Encontrou algum bug? Abra uma issue! <br>
Quer contribuir? Solicite um pull request!
