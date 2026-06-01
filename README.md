# S.A.G.E. — Sistema Auxiliar de Gerenciamento de Estoque

O **S.A.G.E.** é um front-end administrativo para controle de estoque de oficina.  
A estrutura foi organizada para facilitar a integração com back-end e banco de dados SQL.

## Entrada do Projeto

Abra primeiro:

```txt
login.php
```

## Páginas

- `login.php`
- `index.php`
- `estoque.php`
- `movimentacoes.php`
- `relatorios.php`
- `configuracoes.php`

## Organização

```txt
assets/
├── css/
│   ├── base.css
│   ├── layout.css
│   ├── components.css
│   ├── pages.css
│   └── auth.css
│
├── js/
│   ├── core/
│   │   ├── app.js
│   │   ├── api.js
│   │   └── utils.js
│   │
│   ├── components/
│   │   ├── icons.js
│   │   ├── sidebar.js
│   │   ├── topbar.js
│   │   ├── modal.js
│   │   ├── emptyState.js
│   │   └── charts.js
│   │
│   └── pages/
│       ├── login.js
│       ├── dashboard.js
│       ├── estoque.js
│       ├── movimentacoes.js
│       ├── relatorios.js
│       └── configuracoes.js
│
└── vendor/
    └── bootstrap/
        ├── bootstrap.min.css
        └── bootstrap.bundle.min.js
```

## Integração com Back-End

Todos os formulários possuem `action`, `method`, `name` e `data-sage-form`.

Para ativar o envio real pelo back-end, adicione:

```html
data-backend-active="true"
```

Exemplo:

```html
<form action="/parts" method="post" data-sage-form="part" data-backend-active="true">
```

## Dados Zerados

Todas as telas estão preparadas para o banco SQL preencher:

- dashboard zerado;
- tabelas vazias;
- relatórios zerados;
- equipe vazia;
- estoque vazio;
- movimentações vazias.

## Arquivo de API

As rotas estão centralizadas em:

```txt
assets/js/core/api.js
```

## Observação

Os modais usam controlador próprio em `assets/js/components/modal.js` para evitar conflitos de camada, tela escura travando campos ou problemas de foco.
