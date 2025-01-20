# Documentação do Código - E-commerce Laravel

## Visão Geral

Este projeto é um sistema de e-commerce desenvolvido em Laravel. A estrutura foi dividida em módulos, e as principais funcionalidades do sistema são produtos, categorias, marcas, variações, fornecedores, controle de estoque e gestão de imagens. Este documento descreve as tabelas de banco de dados, seus relacionamentos, e os campos definidos até agora.

---

## Estrutura de Banco de Dados

O banco de dados foi organizado em várias tabelas principais, incluindo `products`, `categories`, `brands`, `suppliers`, entre outras. Abaixo estão as descrições de cada tabela e seus campos.

---

### 1. Tabela: `products` (Produtos)

Esta tabela armazena informações sobre os produtos no e-commerce.

| Coluna            | Descrição                                               | Tipo de Dados      |
|-------------------|---------------------------------------------------------|--------------------|
| `id`              | Identificador único do produto                          | `integer`          |
| `name`            | Nome do produto                                         | `string`           |
| `description`     | Descrição do produto                                    | `text`             |
| `category_id`     | ID da categoria a qual o produto pertence               | `integer`          |
| `brand_id`        | ID da marca do produto                                  | `integer`          |
| `supplier_id`     | ID do fornecedor do produto                             | `integer`          |
| `unit_type`       | Tipo de unidade (kg, unidade, etc.)                     | `string`           |
| `created_at`      | Data de criação                                         | `timestamp`        |
| `updated_at`      | Data de atualização                                    | `timestamp`        |

#### Relacionamentos:
- Um **produto** pertence a uma **categoria**.
- Um **produto** pertence a uma **marca**.
- Um **produto** pertence a um **fornecedor**.
- Um **produto** pode ter várias **variações**.
- Um **produto** pode ter várias **imagens**.

---

### 2. Tabela: `categories` (Categorias)

Armazena as categorias dos produtos.

| Coluna            | Descrição                                               | Tipo de Dados      |
|-------------------|---------------------------------------------------------|--------------------|
| `id`              | Identificador único da categoria                        | `integer`          |
| `name`            | Nome da categoria                                       | `string`           |
| `description`     | Descrição da categoria                                  | `text`             |
| `created_at`      | Data de criação                                         | `timestamp`        |
| `updated_at`      | Data de atualização                                    | `timestamp`        |

#### Relacionamentos:
- Uma **categoria** pode ter vários **produtos**.

---

### 3. Tabela: `brands` (Marcas)

Armazena as marcas dos produtos.

| Coluna            | Descrição                                               | Tipo de Dados      |
|-------------------|---------------------------------------------------------|--------------------|
| `id`              | Identificador único da marca                            | `integer`          |
| `name`            | Nome da marca                                           | `string`           |
| `created_at`      | Data de criação                                         | `timestamp`        |
| `updated_at`      | Data de atualização                                    | `timestamp`        |

#### Relacionamentos:
- Uma **marca** pode ter vários **produtos**.

---

### 4. Tabela: `product_variations` (Variações de Produto)

Armazena as variações dos produtos (como tamanho, cor, etc.).

| Coluna            | Descrição                                               | Tipo de Dados      |
|-------------------|---------------------------------------------------------|--------------------|
| `id`              | Identificador único da variação                          | `integer`          |
| `product_id`      | ID do produto relacionado                               | `integer`          |
| `variation_type`  | Tipo da variação (por exemplo, "cor", "tamanho")         | `string`           |
| `variation_value` | Valor da variação (por exemplo, "P", "Vermelho")         | `string`           |
| `price`           | Preço da variação                                       | `decimal`          |
| `weight`          | Peso da variação                                        | `decimal`          |
| `dimensions`      | Dimensões da variação                                   | `string`           |
| `stock`           | Quantidade de estoque disponível para a variação       | `integer`          |
| `created_at`      | Data de criação                                         | `timestamp`        |
| `updated_at`      | Data de atualização                                    | `timestamp`        |

#### Relacionamentos:
- Uma **variação** pertence a um **produto**.

---

### 5. Tabela: `images` (Imagens)

Armazena as imagens dos produtos e variações.

| Coluna            | Descrição                                               | Tipo de Dados      |
|-------------------|---------------------------------------------------------|--------------------|
| `id`              | Identificador único da imagem                           | `integer`          |
| `imageable_id`    | ID do modelo relacionado (produto ou variação)          | `integer`          |
| `imageable_type`  | Tipo do modelo relacionado (`product` ou `product_variation`) | `string`         |
| `image_url`       | URL ou caminho para a imagem                            | `string`           |
| `created_at`      | Data de criação                                         | `timestamp`        |
| `updated_at`      | Data de atualização                                    | `timestamp`        |

#### Relacionamentos:
- Uma **imagem** pertence a um **produto** ou **variação** (relação polimórfica).

---

### 6. Tabela: `suppliers` (Fornecedores)

Armazena os fornecedores dos produtos.

| Coluna            | Descrição                                               | Tipo de Dados      |
|-------------------|---------------------------------------------------------|--------------------|
| `id`              | Identificador único do fornecedor                        | `integer`          |
| `type`            | Tipo de pessoa (Física ou Jurídica)                      | `string`           |
| `cpf`             | CPF do fornecedor (se pessoa física)                     | `string`           |
| `cnpj`            | CNPJ do fornecedor (se pessoa jurídica)                  | `string`           |
| `full_name`       | Nome completo do fornecedor                              | `string`           |
| `fantasy_name`    | Nome fantasia do fornecedor (se pessoa jurídica)         | `string`           |
| `registration_code` | Código de cadastro do fornecedor                        | `string`           |
| `created_at`      | Data de criação                                         | `timestamp`        |
| `updated_at`      | Data de atualização                                    | `timestamp`        |

#### Relacionamentos:
- Um **fornecedor** pode fornecer vários **produtos**.
- Um **fornecedor** pode ter vários **contatos** e **endereços**.

---

### 7. Tabela: `supplier_contacts` (Contatos de Fornecedores)

Armazena os contatos dos fornecedores.

| Coluna            | Descrição                                               | Tipo de Dados      |
|-------------------|---------------------------------------------------------|--------------------|
| `id`              | Identificador único do contato                          | `integer`          |
| `supplier_id`     | ID do fornecedor                                        | `integer`          |
| `email`           | E-mail do contato                                       | `string`           |
| `facebook`        | Facebook do contato                                     | `string`           |
| `instagram`       | Instagram do contato                                    | `string`           |
| `phone`           | Telefone do contato                                     | `string`           |
| `whatsapp`        | WhatsApp do contato                                     | `string`           |
| `contact_name`    | Nome do contato                                         | `string`           |
| `created_at`      | Data de criação                                         | `timestamp`        |
| `updated_at`      | Data de atualização                                    | `timestamp`        |

#### Relacionamentos:
- Um **contato** pertence a um **fornecedor**.

---

### 8. Tabela: `addresses` (Endereços)

Armazena os endereços dos fornecedores e clientes.

| Coluna            | Descrição                                               | Tipo de Dados      |
|-------------------|---------------------------------------------------------|--------------------|
| `id`              | Identificador único do endereço                         | `integer`          |
| `addressable_id`  | ID do modelo relacionado (fornecedor ou cliente)        | `integer`          |
| `addressable_type`| Tipo do modelo relacionado (pode ser `supplier` ou `customer`) | `string`         |
| `type`            | Tipo de endereço (principal, cobrança, entrega, etc.)   | `string`           |
| `cep`             | CEP do endereço                                          | `string`           |
| `number`          | Número do endereço                                       | `string`           |
| `street`          | Rua do endereço                                          | `string`           |
| `complement`      | Complemento do endereço                                  | `string`           |
| `neighborhood`    | Bairro do endereço                                       | `string`           |
| `state`           | Estado do endereço                                       | `string`           |
| `city`            | Cidade do endereço                                       | `string`           |
| `created_at`      | Data de criação                                         | `timestamp`        |
| `updated_at`      | Data de atualização                                    | `timestamp`        |

#### Relacionamentos:
- Um **endereço** pode pertencer a um **fornecedor** ou **cliente** (relação polimórfica).

---

## 9. Tabela: `product_dimensions` (Dimensões dos Produtos)

Armazena as informações de peso e dimensões de um produto.

| Coluna          | Descrição                                                   | Tipo de Dados      |
|-----------------|-------------------------------------------------------------|--------------------|
| `id`            | Identificador único das dimensões do produto                | `integer`          |
| `product_id`    | ID do produto relacionado                                   | `integer`          |
| `net_weight`    | Peso líquido do produto (sem embalagem)                     | `decimal(8, 2)`    |
| `gross_weight`  | Peso bruto do produto (com embalagem)                       | `decimal(8, 2)`    |
| `height`        | Altura do produto (em centímetros ou metros)                | `decimal(8, 2)`    |
| `width`         | Largura do produto (em centímetros ou metros)               | `decimal(8, 2)`    |
| `depth`         | Profundidade do produto (em centímetros ou metros)          | `decimal(8, 2)`    |
| `created_at`    | Data de criação da dimensão do produto                      | `timestamp`        |
| `updated_at`    | Data de atualização da dimensão do produto                  | `timestamp`        |

### Relacionamentos:
- **Um produto** pode ter **uma dimensão associada** (relação `one-to-one`).

---

## Considerações Finais

Essa estrutura de banco de dados foi projetada para atender a um sistema de e-commerce completo, com gerenciamento de produtos, categorias, marcas, fornecedores, variações de produtos e controle de estoque.

### Relacionamentos Gerais:
- Um **produto** pertence a uma **categoria**, **marca** e **fornecedor**.
- Um **produto** pode ter várias **variações** e **imagens**.
- Um **fornecedor** pode ter múltiplos **contatos** e **endereços**.


### O Laravel ERD gera automaticamente Diagramas de Entidade-Relacionamento a partir dos seus modelos Laravel e os exibe usando o erd-editor .

php artisan erd:generate

http://localhost/laravel-erd

---
