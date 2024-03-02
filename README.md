# Laravel Telescope

### Installation
You may use the Composer package manager to install Telescope into your Laravel project:
``` 
composer require laravel/telescope
```
After installing Telescope, publish its assets and  run the `migrate` command in order to create the tables needed to store Telescope's data:
``` 
php artisan telescope:install
 
php artisan migrate
```
### Migration Customization
If you are not going to use Telescope's default migrations, you should call the `Telescope::ignoreMigrations` method in the `register` method of your application's `App\Providers\AppServiceProvider` class. You may export the default migrations using the following command: 
``` 
php artisan vendor:publish --tag=telescope-migrations
```

### Local Only Installation

If you plan to only use Telescope to assist your local development, you may install Telescope using the `--dev` flag:
``` 
composer require laravel/telescope --dev
 
php artisan telescope:install
 
php artisan migrate
```
After running `telescope:install`, you should remove the `TelescopeServiceProvider` service provider registration from your application's `config/app.php` configuration file. Instead, manually register Telescope's service providers in the `register` method of your `App\Providers\AppServiceProvider` class. We will ensure the current environment is local before registering the providers:

``` 
/**
 * Register any application services.
 */
public function register(): void
{
    if ($this->app->environment('local')) {
        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        $this->app->register(TelescopeServiceProvider::class);
    }
}
```

Finally, you should also prevent the Telescope package from being auto-discovered by adding the following to your `composer.json` file:

``` 
"extra": {
    "laravel": {
        "dont-discover": [
            "laravel/telescope"
        ]
    }
},
```

### Dashboard Access & Authorization
The Telescope dashboard may be accessed via the `/telescope` route. By default, you will only be able to access this dashboard in the `local` environment. Within your `app/Providers/TelescopeServiceProvider.php` file, there is an authorization gate definition. This `authorization gate` controls access to Telescope in non-local environments. You are free to modify this gate as needed to restrict access to your Telescope installation:

``` 
use App\Models\User;
 
/**
 * Register the Telescope gate.
 *
 * This gate determines who can access Telescope in non-local environments.
 */
protected function gate(): void
{
    Gate::define('viewTelescope', function (User $user) {
        return in_array($user->email, [
            'taylor@laravel.com',
        ]);
    });
}
```

### See [Laravel Telescpoe](https://laravel.com/docs/10.x/telescope) for more details
