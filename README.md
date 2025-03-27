## Requisitos

* PHP 8.2 ou superior
* Laravel 12 ou superior
* MySQL 8 ou superior
* Composer

## Como rodar o projeto baixado

Duplicar o arquivo ".env.example" e renomear para ".env" <br>
Alterar no arquivo .env as credenciais do banco de dados <br>

Instalar as dependências do PHP
```

composer install
```

Gerar a chave arquivo .env
```

php artisan key:generate
```


## Sequencia para criar o projeto 
Criar o projeto com Laravel
````

composer create-project laravel/laravel
````

Alterar no arquivo .env as credenciais do banco de dados <br>

Criar o arquivo de rotas para API
````

php artisan install:api