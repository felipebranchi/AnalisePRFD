# EcoService

Facilite sua vida de maneira rápida e prática. Poda e remoção de árvores e remoção de lixo.

## Como inicializar o projeto

Para sair usando imediatamente, rode na primeira vez o seguinte

- `git clone git@github.com:felipebranchi/AnalisePRFD.git .`
- `composer install`
- Copie o arquivo `.env.example` para `.env` e altere as variaveis relacionadas
a DB_*. Tenha certeza de já ter criado o banco de dados antes de fazer isso
- `php artisan key:generate` Gera chave, necessario para aplicação rodar da primeria vez
- `php artisan migrate:refresh --seed` # Isto cria e popula as tabelas
- `php artisan serve`
- Acesse http://localhost/`caminho do projeto no seu computador` ex: EcoService

### Comandos

**Servidor local**

- `php artisan serve`
- Acesse http://localhost:8000

**Listar rotas**
- `php artisan route:list`

**Re-executa migrações e insere dados de exemplo**

- `php artisan migrate:refresh --seed`

**Para criar nova classe de seed**

- `php artisan make:seeder UsersTableSeeder`

** Para criar uma nova classe vazia de migration **
- `php artisan make:migration nometabela --create=nometabela`

** Para criar um Controller, exemplo**

- `php artisan make:controller UserController --resource`
- Maiores informações: https://laravel.com/docs/5.2/controllers

** Para criar um Model, exemplo**

- `php artisan make:model User`
- Maiores informações: https://laravel.com/docs/5.2/eloquent

**Re-gerar autoload**

- `php artisan dump-autoload`
- `composer dump-autoload`   # Caso comando anterior falhe

**Debug**

- `dd($eloquent_obj->getQuery()->toSql());` // Exibe query pura
