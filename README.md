## Requisitos

* PHP 8.2 ou superior
* Laravel 12 ou superior
* MySQL 8 ou superior
* Composer

## Como rodar o projeto baixado
Instalar as dependências do projeto

```
composer install
```

Configurar o Banco de Dados


Duplicar o arquivo ".env.example" e renomear para ".env"

Alterar no arquivo .env as credenciais do banco de dados 


Gerar a chave arquivo .env

```
php artisan key:generate
```

Substituir essa key gerada no arquivo ".env"

Rodar as Migrações

```
php artisan migrate
```

Inicie o Apache e o MySql

Rodar em um servidor de teste
```
php artisan serve
```

Rodar as Features

```
php artisan test --filter ProdutoTest
```
