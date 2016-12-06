# Security demo
This project is created to provide a testing environment for anyone who wishes to try out XSS, CSRF or SQL injection. 

## Requirements
 - Laravel 5.3
 - PHP >= 5.6.4
 - OpenSSL PHP Extension
 - PDO PHP Extension
 - Mbstring PHP Extension
 - Tokenizer PHP Extension
 - XML PHP Extension

To fulfill these requirements, I recommend using Homestead and following this guide: https://laravel.com/docs/5.3.

## Installation
When you meet the requirements, run the following commands: 
 - clone the repository `git clone https://github.com/MatthiasKunnen/security-demo.git` to clone the repository
 - `cd security-demo`
 - `composer install`
 - copy .env.example to .env
 - `php artisan key:generate` to regenerate secure key
 - `npm install` to manage assets
 - `php artisan migrate` to create the tables (make sure the database exists)
 - `php artisan db:seed` to create some basic users, posts and comments
 
## Contributing
Please feel free to fork and contribute.
