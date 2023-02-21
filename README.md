
# Eloquent ManyToMany (com tabela pivot) - Relacionamento Muitos para Muitos no Laravel

Explicando de forma prática o relacionamento ManyToMany, através de um pequeno sistema de gerenciamento de uma biblioteca, que conta com a tabela de usuários e outra de livros, onde um usuário pode pegar emprestado vários livros e um livro (com mesmo título), pode ser emprestado para vários usuários. obs: cabe melhorias.


![Logo](https://github.com/cleyton21/images/blob/master/laravel.png)

## Autor

- [@cleyton21](https://github.com/cleyton21)

## Versão do Laravel
Laravel 9


## 🛠 Habilidades
PHP, Laravel, Javascript, HTML, CSS, Bootstrap, Jquery, Ajax


## Melhorias

Você pode iniciar o empréstimo de um livro a um usuário se assim desejar e treinar suas habilidades.


## Rodando localmente

Clone o projeto

```bash
  git clone https://github.com/cleyton21/biblioteca_laravel.git
```

Entre no diretório do projeto

```bash
  cd biblioteca_laravel
```

Instalar as dependências do projeto

```bash
  composer install
```

Configurar conexão com o banco e arquivo .env

Gerar a chave do projeto

```bash
  php artisan key:generate
```

Rode a migration de usuário e a seeder

```bash
  php artisan migrate --seed
```

Rode o restante das seeders

```bash
  php artisan db:seed --class=LivroSeeder
  php artisan db:seed --class=EmprestimoSeeder
```

Inicie o servidor

```bash
  php artisan serve
 ```
 
 Navegue até

```bash
  http://localhost/biblioteca_laravel/public/admin
 ```


## Tela Inicial

![App Screenshot](https://github.com/cleyton21/images/blob/master/biblioteca.png)


## Suporte

Para suporte, mande um email para cfernando_21@hotmail.com.


## Stack utilizada

**Front-end:** HTML, CSS, Bootstrap, Javascript, Jquery

**Back-end:** PHP, Laravel


## Licença

[MIT](https://choosealicense.com/licenses/mit/)

