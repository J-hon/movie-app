# Studio14 task
This application is displays trending movies, allows users to sign up & create a custom movie list.  

### Prerequisites
1. PHP version v8.1
2. MySQL v8.0 (MariaDB will not work. Has to be MySql)
3. Composer v2

# Setting it up
These are the steps to get the app up and running. Once you're using the app.

1. Clone the repository
2. Run `composer install`
3. Run  `cp .env.example .env`
4. Run `php artisan key:generate`
5. Create a MySQL database. Add the database name and password as well as the username to your `.env`
6. Run migrations: `php artisan migrate --seed`
7. Run `php artisan serve` and open [Home](http:://localhost:8000) in your browser

## Request samples
```sh
Register

Endpoint : /api/v1/auth/signup
HTTP Verb: `POST`
{
	"name": "John Doe",
	"email": "johndoe@example.net",
    "password": "xxxxxxx",
    "password_confirmation": "xxxxxxx",
}
```

```sh
Login

Endpoint : /api/v1/auth/login
HTTP Verb: `POST`
{
	"email": "email@example.co",
    "password": "xxxxxxx"
}
```

```sh
Logout

Endpoint : /api/v1/auth/logout
HTTP Verb: `POST`
```

```sh
Get movies

Endpoint : /api/v1/movies
HTTP Verb: `GET`
```

```sh
Get user movie list

Endpoint : /api/v1/user/movies
HTTP Verb: `GET`
```


```sh
Add to movie list

Endpoint : /api/v1/user/movies/add
HTTP Verb: `POST`
{
   "movie_id": id
}
```

```sh
Remove from movie list

Endpoint : /api/v1/user/movies/remove/{id}
HTTP Verb: `DELETE`
```

# Testing
Run `php artisan test` or `vendor/bin/phpunit`
