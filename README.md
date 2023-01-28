<h1 align="center">
<img src="public/image/logo.jpg" alt="simpoLibrary"></h1>

# simpoLibrary

This is simpo library app to view books

- Admin can create,update,view and delete books
- User can register,login,view books, like and comment books


## Installation

- Clone the repo to your local machine
- Run composer update command
- create database of your choice and config the .env file
- Run php artisan migrate:refresh --seed to create database tables and sample data
- Run php artisan passport:install command to create API client secret key
- Run your app php artisan serve
- now you can visit it at localhost:8000
- login with email: admin@gmail.com and password: admin

## RESTApi

- use localhost:8000/api/login on postman to access the user login api
- enter the credentials and copy the token from the response to postman Bearer Auth
- now you can visit other endpoints.

## API endpoint
- list of all books http://localhost:8000/api/books with GET request.
- list of all favourites books http://localhost:8000/api/favourites/books with GET request.

