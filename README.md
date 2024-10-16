## Установка проекта из репозитория
1. Склонируйте репозиторий
```shell
cd domains
git clone https://github.com/ladyaev-na/laravel-api.loc.git
```
2. Перейдите в папку с проектом и установите composer-зависимости
```shell
cd laravel-api.loc
composer install
```
3. Скопируйте файл .env.example в .env
```shell
copy .env.example .env
```
4. Сгенерируйте ключ шифрования
```shell
php artisan key:generate
```
5. Выполнить настройку файла .env
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
```

## Пустой проект 
Создан в OpenServer следующими командыми:

```sh
cd domains
mkdir laravel-api.loc
cd laravel-api.loc
 composer self-update
composer create-project laravel/laravel .
artisan install:api
php artisan config:publish cors
php artisan storage:link
```
В корне проекта создан файд .htaccess
```php
RewriteEngine On
RewriteRule ^(.*)$ public/$1 [L]
```
