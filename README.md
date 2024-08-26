# EdsongrRouter

Uma biblioteca simples e eficiente para gerenciar rotas em aplicações PHP.

## Tecnologias Utilizadas

- **PHP**
- **Composer**

## Requisitos

- PHP 7.4 ou superior
- Composer


## Uso

```php
<?php
require 'vendor/autoload.php';

use Edson\EdsongrRouter\Route;

$router = new Route();

$router->get('/', 'UserController@index');
$router->get('/{id}', 'UserController@get');
$router->post('/', 'UserController@store'); 
$router->put('/', 'UserController@update');
$router->delete('/{id}', 'UserController@delete');

$router->run();
```

## Exemplos de Rotas

### GET `/`

Rota para obter a lista de usuários.

**Controller:**
```php
public function index() {
    // Lógica para listar usuários
}
```

### GET `/{id}`

Rota para obter um usuário específico pelo ID.

**Controller:**
```php
public function get($id) {
    // Lógica para obter um usuário pelo ID
}
```

### POST `/`

Rota para criar um novo usuário.

**Controller:**
```php
public function store() {
    // Lógica para criar um novo usuário
}
```

### PUT `/`

Rota para atualizar um usuário existente.

**Controller:**
```php
public function update() {
    // Lógica para atualizar um usuário
}
```

### DELETE `/{id}`

Rota para deletar um usuário pelo ID.

**Controller:**
```php
public function delete($id) {
    // Lógica para deletar um usuário pelo ID
}
```

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request.

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## Autor

[Edson Oliveira](https://github.com/Edsongr)

## Contato

- **Email:** edsongrdeveloper@gmail.com
- **LinkedIn:** [linkedin.com/in/edsongroliveira](https://www.linkedin.com/in/edsongroliveira/)
