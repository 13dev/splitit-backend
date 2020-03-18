# Splitit

This is RESTful API for splitit using Laravel, **This file is incomplete**

##### Packages:

* JWT-Auth - [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

##### Require:
* PHP: ^7.4

## Installation

#### Clone the Repo:
```
$ git clone {URL_OF_THE_REPO}
```
#### Install Dependencies

```
$ cd project
$ composer install
```

#### Configure the Environment
Create `.env` file:
```
$ cat .env.example > .env
```
Run `php artisan key:generate && php artisan jwt:secret`

#### Migrate and Seed the Database
```
$ php artisan migrate:fresh --seed
```

## Route API Endpoint [WIP]
* Use Swagger [WIP]

| Verb     |                     URI                          |       Controller          |      Notes                                |
| -------- | -----------------------------------------------  | -----------------------   | ------------------------------------------
| POST     | `http://localhost:8000/api/login`              |  AuthController           | to do the login and get your access token
| POST     | `http://localhost:8000/api/register`          |  RegisterController       | to create a new user into your application
| POST     | `http://localhost:8000/api/recovery`          |  ForgotPasswordController | to recover your credentials;
| POST     | `http://localhost:8000/api/reset`             |  ResetPasswordController  | to reset your password after the recovery (setup your mail credentials in `.env` file to avoid error);
| POST     | `http://localhost:8000/api/logout`            |  LogoutController         | to log out the user by invalidating the passed token;
| GET      | `http://localhost:8000/api/profile`           |  ProfileController        | to get current user data
| PUT      | `http://localhost:8000/api/profile`           |  ProfileController        | to update current user data
| PUT      | `http://localhost:8000/api/profile/password`  |  ProfileController        | to update current user password

