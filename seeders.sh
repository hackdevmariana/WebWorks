#!/bin/bash

php artisan db:seed --class="Works\Webworks\Seeders\WebsiteSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\ErrorPageSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\SocialNetworkSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\SectionHeadingSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\ScreenSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\CustomMenuSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\LinkSeeder"

php artisan db:seed --class="Works\Webworks\Seeders\CopySeeder"
php artisan db:seed --class="Works\Webworks\Seeders\ContactSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\DevelopedSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\VideoSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\ContentSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\StringContentSeeder"
php artisan db:seed --class="Works\Webworks\Seeders\ImageContentSeeder"

