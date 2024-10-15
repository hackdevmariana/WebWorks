#!/bin/bash

php artisan db:seed --class="Works\Dictionaryworks\Seeders\DictionaryTermSeeder"
php artisan db:seed --class="Works\Dictionaryworks\Seeders\DictionarySubjectSeeder"
php artisan db:seed --class="Works\Dictionaryworks\Seeders\DictionaryCategorySeeder"
php artisan db:seed --class="Works\Dictionaryworks\Seeders\DictionaryTagSeeder"
