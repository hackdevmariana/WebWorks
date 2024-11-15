# WebWorks

It provides the information needed for standard websites through a read-only API.

For static websites, you can insert the data through seeders.

For dynamic websites, you can manage the database information by installing a control panel, such as [WebWorksDashboard](https://github.com/hackdevmariana/WebWorksDashboard) (based on FilamentPHP).

Supports multi site.

## Routes

- /api/v1/webs -> Lists basic information about all websites in the system.
- /api/v1/webs/{slug} -> Lists basic information about a specific website by slug.

## Inserting information into the database

You can fill the database information with the following seeders:

In the **/packages/works/web/src/Seeder** directory:

- WebSeeder.php -> Basic information for websites (name, title, favicon...).

## License

The WebWorks application is open-sourced software licensed under the [GPL v.3](https://www.gnu.org/licenses/gpl-3.0.txt).
