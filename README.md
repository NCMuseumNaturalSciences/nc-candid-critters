# NC Candid Critters (nc-candid-critters)
NC Candid Critters Project and Volunteer Management System

*Laravel 5.5*

*Packages:*
* guzzlehttp/guzzle
* intervention/image
* laravelcollective/html
* maatwebsite/excel
* nesbot/carbon
* spatie/laravel-fractal
* spatie/laravel-permission
* yajra/laravel-datatables-buttons

*To Install*
1. Clone repo or export and extract zip archive
2. Create MySQL database
3. Rename .env.example to .env and edit accordingly
4. Open command line
5. Run the following commands:  
    composer install  
    composer update  
    php artisan key:generate  
    php artisan make:auth  
    php artisan vendor:publish  
6. Make any desired changes to the authentication system (I always split name into first and last).  
    php artisan migrate  

