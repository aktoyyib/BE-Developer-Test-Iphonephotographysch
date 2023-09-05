**Installation**

1. Download the repo from https://github.com/aktoyyib/BE-Developer-Test-Iphonephotographysch
2. From the root directory run `composer install`
3. You must have a MySQL database running locally
4. Update the database details in `.env` to match your local setup
5. Run `php artisan migrate` to setup the database tables


**To run tests**
1. Create the database/test.sqlite file:     touch database/test.sqlite
2. Migrate and seed the test database:        php artisan migrate --seed --env=testing
3. Run tests: vendor/bin/phpunit
