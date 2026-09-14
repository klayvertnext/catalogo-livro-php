 Catálogo de Livros

Sistema CRUD simples para gerenciamento de um catálogo de livros, desenvolvido como desafio técnico para processo seletivo de estágio em Desenvolvimento.

O projeto permite cadastrar, listar, editar e excluir livros, com validações tanto no navegador quanto no servidor.

---

 Tecnologias utilizadas

- HTML5
- CSS3
- JavaScript
- PHP 8
- MySQL / MariaDB
- PDO
- Git
- GitHub

---

 Funcionalidades

- Cadastro de livros
- Listagem de livros
- Edição de registros
- Exclusão de livros
- Confirmação antes da exclusão
- Validação no navegador com JavaScript
- Validação no servidor com PHP
- Mensagens de sucesso e erro
- Status de disponibilidade
- Interface responsiva
- Tratamento de registros inexistentes
- Proteção contra SQL Injection utilizando prepared statements
- Tratamento de saída com `htmlspecialchars()`

---

 Dados do livro

Cada livro possui os seguintes campos:

- Título
- Autor
- Categoria
- Status

Os status disponíveis são:

- Disponível
- Indisponível

---

 Estrutura do projeto

```text
catalogo-livros/
│
├── assets/
│   ├── css/
│   │   └── style.css
│   │
│   └── js/
│       └── validation.js
│
├── config/
│   └── database.php
│
├── database/
│   └── database.sql
│
├── create.php
├── delete.php
├── edit.php
├── index.php
├── .gitignore
└── README.md
---

 Requisitos

Para executar o projeto localmente, é necessário ter:

- PHP 8 ou superior
- Apache
- MySQL ou MariaDB
- XAMPP, WAMP ou ambiente equivalente

O projeto foi desenvolvido utilizando XAMPP.



 Como executar o projeto

 1. Clone o repositório

```bash
git clone https://github.com/klayvertnext/catalogo-livro-php.git