<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Step to project setup:
1. download or clone project
2. Go to the folder application using cd
3. Run "composer install" on your cmd or terminal
4. Copy .env.example file to .env on root folder. 
    You can type "copy .env.example .env" if using command prompt Windows 
     or cp .env.example .env if using terminal Ubuntu
5. Open your .env file and change the database name (DB_DATABASE)
6. Run "php artisan key:generate"
7. Run "php artisan jwt:secret"
8. Run "php artisan migrate"
9. Run "php artisan migrate --path=/database/migrations/2021_04_11_223228_create_postlikes_table.php"
10. Run "php artisan migrate --path=/database/migrations/2021_04_11_232359_create_postcomments_table.php"
11.Run "php artisan serve"

## Postman Documentation
https://documenter.getpostman.com/view/3788108/TzCV456m
