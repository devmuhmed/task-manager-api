
## How could you install and make a project working After Clone
update .env file your database with it's your own credentials and generate your app_key

first make sure to install the composer requirements
```php
composer install
```
second run the migrations this application
```php
php artisan migrate
```
third run seeder this step will generate four users and 100 tasks per user random except one user we will use for login the application

```php
php artisan db:seed
```


the credentials of the user to login
```php
email => "mohamed@admin.com"
Password => "123456"
```

