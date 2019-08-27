# SendFox Code Challenge
## Laravel, React and Draftjs

**Problem**: We’ve been wanting to migrate our email editor to one with more flexibility for long run, thinking using Facebook's Draft.js would best.  We need your help and this is
 a realistic project you’d work on at SendFox and Sumo Group.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
PHP 7.1
MySQL
NodeJs
NPM
React
React-Dom
Draftjs
```

### Installing

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

```
git clone git@github.com:juliosolis/laravel-react-draftjs.git
```

Switch to the repo folder

```
cd laravel-react-draftjs
```

Install all the dependencies using composer

```
composer install
```

Copy the example env file and make the required configuration changes in the .env file

```
cp .env.example .env
```

Generate a new application key

```
php artisan key:generate
```

Run the database migrations (**Set the database connection in .env before migrating**)

```
php artisan migrate --seed
```

Compile, bundle and minify all CSS and JS files. (**mostly for production**)

```
npm run prod
```

Start the local development server

```
php artisan serve
```

**TL;DR command list**

```
git clone git@github.com:juliosolis/laravel-react-draftjs.git
cd laravel-react-draftjs
composer install
cp .env.example .env
php artisan key:generate
```
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

```
php artisan migrate --seed
php artisan serve
```

You can now access the server at http://localhost:8000 with credentials

```
user: admin@admin.com
password: admin
```

Check it live here

```
https://challenge.juliosolis.com/
```

Next Steps

```
Separate API request to api.php routes file
Use Laravel passport to improve API request security
```

## Built With

* [Laravel](https://laravel.com/docs/5.8) - The PHP Framework for Web Artisans
* [React](https://reactjs.org/docs/getting-started.html) - A JavaScript library for building user interfaces
* [Draftjs](https://draftjs.org/docs/getting-started) - RICH TEXT EDITOR FRAMEWORK FOR REACT

## Authors

* **Julio Solis** [LinkedIn](https://www.linkedin.com/in/juliosolisl/)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details