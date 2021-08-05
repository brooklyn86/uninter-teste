<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Requisitos:
    * PHP >= 7.3
    * Composer
    * NPM ou Yarn
    
## Instalação: 
   Para efetuar a instalação dessa aplicação você deve efetuar o clone desse repositorio,
   logo apos você deve rodar o comando no seu terminal dentro da pasta do projeto:
    
   ```composer install```
   
   Quando concluir a instalação das dependencia via composer deve se rodar o comando 
   ```npm install``` ou ```yarn install```
   esse comando será responsavel por instalar as dependencias do vue js
   
   Quando o comando concluir a sua instalação rode o comando:
   ```npm run dev``` ou ```yarn dev```
   esse comando vai efetuar o build dos componentes do vue js
   
 ## Copiando o arquivo .env
 
 Para que a apliação funcione normalmente você deve copiar o arquivo .env.example e renomear para .env
 
 
 ## Adicionando o banco de dados 
 Abra o seu arquivo .env com o seu editor de textos e procure as seguintes linhas 
 
 * DB_CONNECTION=mysql
 * DB_HOST=127.0.0.1
 * DB_PORT=3306
 * DB_DATABASE=benfetoria
 * DB_USERNAME=root
 * DB_PASSWORD=
 
 troqueas para as informações correspondentes ao seu banco de dados
 
 ## Rodando as migrations 
 
 Para criar as tabelas do banco de dados basta rodar o comando ```php artisan migrate``` que a aplicação automaticamente irá criar as tabelas no banco de dados
 
 ##Criando uma nova Key de criptografia
   a aplicação laravel ela utiliza uma chave para a criptografia de algumas informações sem essa chave a sua aplicação não irá funcionar! para criar uma nova chave basta rodar o comando em seu terminal: ```php artisan key:generate```
   
  ## Rodando a aplicação 
  
  Rode o em seu terminal o comando: ```php artisan serve``` e a sua aplicação irá funcionar na porta 8000 do seu computador, para acesar basta acessar a seguinte url em seu navegador: http://localhost:8000
 
 
