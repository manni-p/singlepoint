# Read Me

## Installation instructions

To install this project on your local machine, please follow:

* Minimum PHP 7.1.3
* run composer update to get latest vendor options
* There needs to be an .env file set up, please use the example provided (.env.example) and fill in the correct details
* In command line/terminal cd into the root directory and run $ php artisan migrate
* This will build up the database with the correct tables
* chmod -R 777 the storage directory
* Please run seeders for the database this will create a standard user name and password or register through the website
* Username: mandip_purewal@hotmail.co.uk and Password: password1
* Run: php artisan db:seed --class=UsersTableSeeder and php artisan db:seed --class=ApiListSeeder
* API List Seeder will add the API list to the database

## How it works

This application has a control panel which lists the API feeds given from the document and allows you to import the each list into the database, this will skip duplicate names if the category and location are different.

This will then place the data in a section which will allow the user to publish the location. Once the user is happy an API is created. This API is cached for up to 1 hour and the user can clear the cache through the control panel.

This application uses a public API but also OAuth 2 (which can be tested through Postman)

* URL for public API is http://www.topcatclients.com/technical-task/api/p/endpoint
* URL for OAuth 2 is http://www.topcatclients.com/technical-task/api/endpoint with Bearer token coming from http://www.topcatclients.com/consumer/