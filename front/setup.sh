#!/usr/bin
composer install
bun install
./artisan key:generatete
touch database/database.sqlite
./artisan migrate
echo Remember to run both bun install and ./artisan serve to execute the server!
