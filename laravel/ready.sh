#!/bin/bash
composer install
./artisan migrate
./artisan db:seed
./artisan serve
