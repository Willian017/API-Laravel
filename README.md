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

## Como usar

Esta API é sobre uma tabela de Produtos

Ao rodar a API é necessario fazer um cadastro de usuario, Faça isso com a rota: /api/registro

Nela sera necessario o envio dos seguintes campos:
```
{
	"name": "",
	"email": "",
	"password": "",
	"password_confirmation": ""
}
```

Apos isso vá ate a rota:/api/login e use o seu email e sua senha criados anteriormente para logar
```
{
	"email": "",
	"password": ""
}
```

Feito o Login use token retornado para realizar a autenticação nos metodos: store, update e destroy

Para se deslogar vá na rota:api/logout e use o seu token de autenticação


## Rotas Produtos

Campos da Tabela Produtos:
{
    "id": ,
    "nome": "",
    "descricao": "",
    "preco": ,
    "estoque": 
}

Para acessar o index utilize a rota:/api/index, caso queira utilizar o filter use a mesma rota so que com '?nome=' e na frente o nome do produto que deseja buscar

Para acessar o show utilize a rota:/api/show/{id}

Para acessar o store utilize a rota:/api/store, use sua chave de autenticação e insira os dados para a Inserção
```
{
    "nome": "",
    "descricao": "",
    "preco": ,
    "estoque": 
}
```

Para acessar o update utilize a rota:/api/update/{id}, use sua chave de autenticação e insira os dados para a 
Atualização
```
{
    "nome": "",
    "descricao": "",
    "preco": ,
    "estoque": 
}
```

Para acessar o delete utilize a rota:/api/delete{id}, use sua chave de autenticação 



