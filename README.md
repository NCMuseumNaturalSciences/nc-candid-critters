# NC Candid Critters (nc-candid-critters)
NC Candid Critters Project and Volunteer Management System

The management of volunteers and equipment over large scales requires logistics and organizational tools. We originally used 60 Google Sheets to manage volunteer signups, training, deployments and equipment movements, but this quickly became cumbersome and error prone. Thus, we established a database to replace Google Sheets two-thirds of the way through the project, cutting volunteer management time by approximately 30%. The management database was built using the Laravel MVC Framework with a MYSQL database backend allowing camera management, tracking volunteer training, site mapping and custom report generation.   

Whether projects are able to use simple data management systems (i.e., Google Sheets) or need to develop a new system will depend on the size of the project and the needs of the managers. We suggest that large citizen science projects establish a database from the start to manage volunteers and inventory. If possible, using established databases developed by similar citizen science projects would be more time and cost effective.

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

