Laravel API Setup Guide
This guide will help you set up and run your Laravel API project, and test it using Postman.

1.  Git clone https://github.com/joseneves-dev/agilecontent.git

2.  Install Composer dependencies:
    composer install

3.  Generate the application key:
    php artisan key:generate

4.  Set up database configuration:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_name
    DB_USERNAME=database_user
    DB_PASSWORD=database_password

5.  Run database migrations & seed:
    php artisan migrate
    php artisan db:seed

6.  Start the Laravel development server:
    php artisan serve

7.  Testing with Postman

    http://127.0.0.1:8000/api/login -> POST METHOD
    {
    "email": string,
    "password": string
    }

    http://127.0.0.1:8000/api/register -> POST METHOD

    {
    "name": string,
    "email": string,
    "password": string,
    "password_confirmation": string,
    "countryId": number (1 to 10)
    }

    To the next routers in PostMan use :

    Auth Type -> Bearer Token use the token return from login
    Header: ->"Accept" : "application/json"

    http://127.0.0.1:8000/api/user/show -> GET METHOD

    http://127.0.0.1:8000/api/user/update -> PUT METHOD (once user inactive 403 forbidden)

    {
    "name": string,
    "email": string,
    "password": string,
    "password_confirmation": string,
    "countryId": number (1 to 10)
    }

    http://127.0.0.1:8000/api/user/delete -> DELETE METHOD
