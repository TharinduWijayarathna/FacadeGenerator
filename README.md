# Laravel Domain Generator

_Laravel Domain Generator_ is a package that provides a convenient way to generate domain services and facades in your Laravel application.

---

**Installation**

You can install the package via Composer:

```bash
composer require tharindu/facade_generator
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

## Autoloading the Domain Directory

To ensure Laravel autoloads your custom `domain` directory, you need to update the `composer.json` file of your Laravel application. Follow these steps:

1. **Open your Laravel application's `composer.json` file.**

2. **Locate the `autoload` section.** It should look something like this:

   ```json
   "autoload": {
       "psr-4": {
           "App\\": "app/"
       },
       "classmap": [
           "database/seeds",
           "database/factories"
       ]
   },
   ```

3. **Add your `domain` directory to the PSR-4 autoloading section.** If your domain directory is located at the root of your Laravel application, you can add it like this:

   ```json
   "autoload": {
       "psr-4": {
           "App\\": "app/",
           "Domain\\": "domain/"
       },
       "classmap": [
           "database/seeds",
           "database/factories"
       ]
   },
   ```

   Make sure to adjust the path `"Domain\\"` and `"domain/"` according to the actual structure of your application.

4. **Run `composer dump-autoload`** to regenerate the Composer autoloader files:

   ```bash
   composer dump-autoload
   ```

Once you've made these changes, Laravel will autoload classes from your `domain` directory just like it does with the `app` directory, making your domain logic easily accessible throughout your application.

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
<?php

namespace Domain\Services\UserService;

use App\Models\User;

class UserService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function get(int $user_id)
    {
        return $this->user->find($user_id);
    }

    public function create(array $data)
    {
       return $this->user->create($data);
    }

    public function read($id)
    {
        // Implement read functionality
    }

     protected function edit(User $user, array $data)
    {
        return array_merge($user->toArray(), $data);
    }

    public function update($user_id , array $data)
    {
        $user = $this->user->find($user_id);
        return $user->update($this->edit($user, $data));
    }

    public function delete($id)
    {
       $user = $this->user->find($id);
       return $user->delete();
    }

    public function list()
    {
       return $this->user->all();
    }
}
```

---

**Contributing**

Contributions are welcome! Please feel free to submit a pull request.

---

**License**

The Laravel Domain Generator is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
