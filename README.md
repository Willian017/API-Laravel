## Requisitos

* PHP 8.2 ou superior
* Laravel 12 ou superior
* MySQL 8 ou superior
* Composer

## Como rodar o projeto baixado

Duplicar o arquivo ".env.example" e renomear para ".env" <br>
Alterar no arquivo .env as credenciais do banco de dados <br>

Instalar as dependências do projeto

```
composer install
```

Configurar o Banco de Dados

Pegue as informações do arquivo .env.example e coloque no arquivo .env

Gerar a chave arquivo .env

```
php artisan key:generate
```

Substituir essa key gerada no arquivo .env

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
