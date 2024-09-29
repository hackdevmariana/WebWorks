#!/bin/bash

php artisan db:seed --class="Works\Webworks\Seeders\WebsiteSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\ErrorPageSeeder"

