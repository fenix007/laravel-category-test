## Laravel nested category with products
On backend used Laravel 5.4 with baum/baum (library does not support Laravel 5.5+)
# Deploy backend
```bash
composer install
```

Change .env file and set DB parameters (for prod and test db)
```bash
php artisan migrate
php artisan db:seed
```

Check tests
```bash
 php artisan migrate --database=test
./vendor/bin/phpunit
```

Run backend server
```bash
php artisan serve
```

On Frontend used Vue js 2, vue-resource, vue-router, vue-tree-navigation, bulma
# Deploy frontend
```bash
npm i

// Run all Mix tasks...
npm run dev

// Run all Mix tasks and minify output...
npm run production

// Fore development
npm run watch
```

[Check result](http://joxi.ru/l2ZY0qJHw3x61m)
