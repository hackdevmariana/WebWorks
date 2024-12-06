# WebWorks

Manage and host the content of one or more websites through a read-only API.

For static websites, you can insert the data through seeders.

Manage the information to be served to the frontend through a Filament-based control panel.

Supports multi site.


## Install project

Clone the repository:

``` sh 
git clone https://github.com/hackdevmariana/WebWorks.git
``` 

Install Laravel dependencies:

``` sh 
composer install
``` 

Install JavaScript dependencies:

``` sh 
npm install
``` 

Rename .env file:

``` sh 
cp .env.example .env
``` 

Generate the application key:

``` sh
php artisan key:generate
``` 

Create the database structure:

``` sh 
php artisan migrate
``` 

Seed the database:

``` sh 
php artisan db:seed
``` 


## Routes

- /api/v1/webs -> Lists basic information about all websites in the system.
- /api/v1/webs/{webSlug} -> Lists basic information about a specific website by slug.
- /api/v1/webs/{webSlug}/content -> Lists all the content associated with a website.
- /api/v1/webs/{webSlug}/content/{contentSlug} -> Displays the content associated with a slug.

## Inserting information into the database

You can fill the database information with the following seeders:

In the **/packages/works/web/src/Seeder** directory:

- WebSeeder.php -> Basic information for websites (name, title, favicon...).

## License

The WebWorks application is open-sourced software licensed under the [GPL v.3](https://www.gnu.org/licenses/gpl-3.0.txt).
