## Teste Backend 123 Milhas

Introdução
Atualmente utilizamos diversas APIs para buscar voos, e após receber os resultados é
necessário fazer o agrupamento entre as idas e voltas.
Nesse teste você irá desenvolver uma API que faz esse agrupamento de voos.
Disponibilizamos uma API onde você irá consultar os vôos a serem agrupados. No total são
15 voos, categorizados em 2 tipos de tarifa.
Requisitos
Será necessário utilizar algum desses frameworks para desenvolver o projeto:
- Laravel (​ https://laravel.com/​ )
- Lumen (​ https://lumen.laravel.com/​ )
Entregas

- Será necessário entregar todo o código gerado no teste
- Como é uma API você também pode anexar sua rota.
- Entregue uma documentação com todos os passos para executar seu projeto.
- Disponibilize o código e a documentação em um link no github, ou em um arquivo
zip para download.

[opcional]: ​ Utilizar o GitHub para fazer a entrega é um diferencial
[opcional]: ​ Utilizar o Swagger, Postman ou algo similar para documentar sua rota é um
diferencial
[opcional]:​ Disponibilizar o teste na internet, para que possa ser testado via navegador ou
postman é um diferencial
Pontos de Avaliação

- Toda a estrutura da sua API; (Rota, HTTP response, HTTP Status, etc..)
- Nomenclatura e padronização das suas variáveis, funções, classes;
- Separação de responsabilidades;
- Lógica e otimização de processamento;

# Requisitos
Composer
PHP 7.4
# Instalação

## Clone este repositório
$ git clone https://github.com/lamas250/123milhas.git

## Acesse a pasta do projeto no terminal/cmd
$ cd /path/123milhas

## Instale as dependências
$ composer install

## Crie uma copia do .env-exmaple
$ cp .env-example .env

## Gere a Key do .env
$ php artisan key:generate

## Execute a aplicação em modo de desenvolvimento
$ php artisan serve

## Endpoint api teste

<h1 align="center">
    <a href="http://localhost:8000/api/flights">🔗 http://localhost:8000/api/flights</a>
</h1>




