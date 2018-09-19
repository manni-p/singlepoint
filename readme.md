# Read Me

## Installation instructions

To install this project on your local machine, please follow:

* run composer update to get latest vendor options
* There needs to a .env file set up, please use the example provided (.env.example) and fill in the correct details
* In command line/terminal cd into the root directory and run $ php artisan migrate
* This will build up the database with the correct tables
* chmod -R 777 the storage directory
* Please run seeders for the database this will create a standard user name and password or register through the website
* Username: mandip_purewal@hotmail.co.uk and Password: password1
* Run: php artisan db:seed --class=UsersTableSeeder and php artisan db:seed --class=ApiListSeeder
* API List Seeder will add the API list to the database

## How it works

This application uses a public API but also OAuth 2 (which can be tested through Postman)

* URL for public API is ...
* URL for OAuth 2 is ... with Bearer token ..