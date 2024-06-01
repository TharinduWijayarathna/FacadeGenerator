# Laravel Domain Generator

_Laravel Domain Generator_ is a package that provides a convenient way to generate domain services and facades in your Laravel application.

---

**Installation**

You can install the package via Composer:

```bash
composer require tharindu/ddd_generator
```

**Usage**

To generate a domain service and facade, use the `make:domain` Artisan command:

```bash
php artisan make:domain User
```

This command will create the following files in the `domain` directory:

- `ServiceNameFacade.php`
- `ServiceNameService.php`

You can then use these files to implement your domain logic.

---

**Functionalities**

The package provides the following functionalities:

1. **Generation of Domain Service and Facade**: Easily create domain services and facades using the `make:domain` command.
2. **CRUD Functionality**: The generated service stubs include basic CRUD operations for managing domain entities.
   - _Create_: Create new domain entities.
   - _Read_: Retrieve specific domain entities.
   - _Update_: Update existing domain entities.
   - _Delete_: Delete domain entities.
   - _List_: Retrieve a list of domain entities.

---

**Examples**

_Generating a Domain_

To generate a domain service and facade named `User`, run:

```bash
php artisan make:domain User
```

This will create `UserFacade.php` and `UserService.php` in the `domain` directory.

_Using the Generated Files_

Once the files are generated, you can implement your domain logic inside the service methods. For example:

```php
// app/domain/Services/UserService.php

namespace Domain\Services;

class UserService
{
    public function create(array $data)
    {
        // Implement create functionality
    }

    public function read($id)
    {
        // Implement read functionality
    }

    public function update($id, array $data)
    {
        // Implement update functionality
    }

    public function delete($id)
    {
        // Implement delete functionality
    }

    public function list()
    {
        // Implement list functionality
    }
}
```

---

**Contributing**

Contributions are welcome! Please feel free to submit a pull request.

---

**License**

The Laravel Domain Generator is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
