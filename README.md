# Desafio Comerc

## Backend Pedidos Pastelaria

## Sobre

Backend desenvolvido para cadastro de clientes, produtos e pedidos para o teste da Comerc.
A aplicação utiliza as seguintes tecnologias:

-   PHP 8.2
-   Apache
-   Postgress
-   Laravel 10
-   Docker
-   Docker Compose

## Instalação

-   Clone o repositório
-   Após navegar até a pasta do projeto, excute o comando abaixo para criar os conteiners no Docker.

```sh
docker-compose up
```

-   Após finalizar crie um banco de dados chamado "orders_api"
-   Após rode o comando abaixo para instalar as depencias do projeto:

```sh
composer install
```

-   Configure o arquivo .env com os dados de acesso a base de dados e ao serviço de disparo de e-mails das sua preferencia.
-   Após rode os comandos para criar as tabelas e popular:

```sh
php artisan migrate
php artisan db:seed
```

-   Feito isso a aplicação estará pronta para ser testada.

## Testes

A aplicação possui testes automatizados incluidos basta rodar o comando:

```sh
php artisan test
```
