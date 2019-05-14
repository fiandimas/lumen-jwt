## Lumen JWT (5.8)

Server requirement

- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension

Install this project

1. Download and install Composer (https://getcomposer.org/)
2. Open your cmd and set path to this project
3. Run "composer install"
4. Copy .env.example to .env
5. Set mysql connection (host,user,pass,db), JWT_SECRET and APP_KEY
6. Run "php artisan migrate"
7. Run "php artisan db:seed"
8. Run "php -S localhost:8000 -t public"
9. Enjoy
