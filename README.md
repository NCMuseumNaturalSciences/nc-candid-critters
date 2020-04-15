# nc-candid-critters
NC Candid Critters Project and Volunteer Management System

Laravel 5.5

Packages:
guzzlehttp/guzzle
intervention/image
laravelcollective/html
maatwebsite/excel
nesbot/carbon
spatie/laravel-fractal
spatie/laravel-permission
yajra/laravel-datatables-buttons

To Install
Clone repo or export and extract zip archive
Create MySQL database
Rename .env.example to .env and edit accordingly
Open command line
Run the following commands:
composer install
composer update
php artisan key:generate
php artisan make:auth
php artisan vendor:publish
Make any desired changes to the authentication system (I always split name into first and last).
php artisan migrate

