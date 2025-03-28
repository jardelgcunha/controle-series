# Sistema de Controle de Séries

O **Sistema de Controle de Séries** é uma aplicação web desenvolvida com **PHP 8.2.3** e framework **Laravel 12**, que permite ao usuário gerenciar séries, temporadas e episódios. O sistema oferece funcionalidades como cadastro, edição, remoção e listagem de séries, com um fluxo de autenticação de usuário, além de envio de emails para os usuários sobre séries recém-criadas. O banco de dados utilizado é o **SQLite**.

## Tecnologias Utilizadas

- **PHP 8.2.3**
- **Laravel 12**
- **Blade**, **Bootstrap**, **HTML**, **CSS** e **Javascript** para a interface
- **SQLite** para o banco de dados
- **Mailtrap** para o disparo de emails SMTP
- **Storage** para o armazenamento de imagens
- **Autenticação**, **Validações**, **Eventos**, **Jobs**, **Listeners** e **Middlewares**
- **Fila de Processamento** para o envio de múltiplos emails
- **Injeção de Dependência** e **Transações** para otimização da aplicação

## Funcionalidades

- **Gestão de Usuários**: Usuários podem se registrar no sistema, fazer login e logout.
- **Gestão de Séries**: Cadastrar uma série com temporadas, episódios e capa (imagem), editar nome da série e capa (imagem), exibir e remover séries.
- **Gestão de Temporadas e Episódios**: Visualização de temporadas e episódios, além de marcação e visualização de episódios como assistidos.
- **Envio de Email**: Disparo de um email para todos os usuários quando uma nova série é criada e registro no log. O envio de emails para os usuários é processado em segundo plano utilizando Jobs e Filas para garantir que o envio de múltiplos emails não sobrecarregue o servidor no envio assíncrono de emails.
- **Middleware de Autenticação**: O sistema utiliza um middleware para garantir que apenas usuários autenticados possam acessar determinadas rotas, como a criação, edição e remoção de séries, temporadas e episódios.
- **Mensagens, Validações e Feedbacks ao Usuário**: Após ações como a criação, edição ou exclusão de uma série, temporada ou episódio, o sistema exibe uma mensagem de sucesso ou erro ao usuário. Essas mensagens são passadas através da sessão e aparecem na tela como notificações. Além disso, o sistema valida as regras de validação, caso não cumpra com os requisitos retorna uma mensagem de erro.
- **Armazenamento de Imagens**: Ao cadastrar ou editar uma série, o administrador pode carregar uma imagem para ser usada como capa da série. O Laravel gerencia o armazenamento de arquivos, e as imagens são armazenadas no diretório de armazenamento público. Caso o administrador não forneça uma imagem de capa, o sistema exibe uma imagem padrão para representar a série.
- **Eventos, Listeners, Jobs e Filas**:Quando uma nova série é criada, um evento é disparado. Esse evento contém informações sobre a série, como nome, ID, quantidade de temporadas e episódios por temporada.

## Requisitos

- **PHP 8.2.3**
- **Composer** para gerenciar as dependências do Laravel
- **SQLite** para o banco de dados
- **Mailtrap** para configuração do envio de emails

## Estrutura de Diretórios

A estrutura de diretórios do projeto segue o padrão do Laravel:

```
/app
    /Events
    /Http
        /Controllers
        /Middleware
        /Requests
    /Jobs
    /Listeners
    /Mail
    /Models
    /Providers
    /Repositories
/config
/database
    /factories
    /migrations
    /seeders
/public
    /storage
        /series_cover
/resources
    /css
    /jss
    /sass
    /views
/routes
/storage
    /app
        /private
        /public
    /debugbar
    /framework
    /logs
```

---

## Rotas e Controle de Acesso

### **Rotas Principais**

| Método | Rota | Ação | Controle |
|--------|------|------|----------|
| `GET`  | `/login` | Exibe o formulário de login | `LoginController@index` |
| `POST` | `/login` | Realiza o login | `LoginController@store` |
| `GET`  | `/logout` | Realiza o logout | `LoginController@destroy` |
| `GET`  | `/register` | Exibe o formulário de registro | `UsersController@create` |
| `POST` | `/register` | Registra o novo usuário | `UsersController@store` |
| `GET`  | `/series` | Exibe a lista de séries | `SeriesController@index` |
| `GET`  | `/series/create` | Exibe o formulário de criação de série | `SeriesController@create` |
| `POST` | `/series` | Cria uma nova série | `SeriesController@store` |
| `GET`  | `/series/{series}/edit` | Exibe o formulário de edição de série | `SeriesController@edit` |
| `PUT`  | `/series/{series}` | Atualiza uma série existente | `SeriesController@update` |
| `DELETE` | `/series/{series}` | Remove uma série | `SeriesController@destroy` |
| `GET`  | `/series/{series}/seasons` | Exibe as temporadas de uma série | `SeasonsController@index` |
| `GET`  | `/seasons/{season}/episodes` | Exibe os episódios de uma temporada | `EpisodesController@index` |
| `POST` | `/seasons/{season}/episodes` | Marca episódios como assistidos | `EpisodesController@update` |

## Configuração

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/controle-series.git
   cd controle-series
   ```

2. Instale as dependências com o Composer:
   ```bash
   composer install
   ```

3. Configure o banco de dados SQLite no arquivo `.env`:
   ```bash
   DB_CONNECTION=sqlite
   DB_DATABASE=/path/to/database/database.sqlite
   ```

4. Execute as migrations para criar as tabelas no banco de dados:
   ```bash
   php artisan migrate
   ```

5. Configure o envio de emails no **Mailtrap** e ajuste as configurações no arquivo `.env`.

6. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

## Testes

A aplicação já inclui testes básicos para validar o funcionamento das rotas e funcionalidades principais. Para rodar os testes, execute:

```bash
php artisan test
```

## Conclusão

O **Sistema de Controle de Séries** é uma aplicação robusta e fácil de usar para gerenciar séries, temporadas e episódios, com suporte para autenticação de usuários, envio de emails assíncronos e muito mais. O sistema é desenvolvido em Laravel, aproveitando ao máximo os recursos do framework para proporcionar uma experiência de usuário fluída e eficiente.

