# Class Management Software

##### Build With Laravel 5.6

![ERD](readme-resources/entity-relationship-diagram.png?raw=true "ERD")

##### How to use it:

- Clone this repository
- open cmd, go to directory of repository and type composer install
- create database 
- create .env by copy .env.example and update .env with your database config
- open cmd, go to directory of repository and type php artisan migrate:refresh --seed
- open cmd, go to directory of repository and type php artisan serve
- create bot 
- set TELEGRAM_BOT_TOKEN
- seacrh your bot then start 
- add your id telegram to database , table user , id_telegram
- you can login with email admin@gmail.com and password admin123
