# Installation

Book Manager is a Full Stack Web application using laravel api and vue js 3 for managing Books

* Clone this repository to your local computer

```bash
git clone https://github.com/ronald-kimeli/book-manager.git
```

* Navigate to laravel api backend.

```bash
cd laravel-api
```

* Install necessary dependencies

```bash
composer install
```

* Set the application Key for laravel to run

```bash
php artisan key:generate
```

* Copy and set .env from .env.example

```bash
cp .env.example .env
```

* Set your database credentials

* Run migation and seed database for dummy data

```bash
php artisan migrate --seed 
```

* Spin the server then Laravel is ready for connection

```bash
php artisan serve
```

## Vue Frontend

* Navigate to vue frontend on the other terminal

```bash
cd vue_frontend
```

* Install necessary dependencies

> You can use either yarn or npm according to your preferences

```bash
yarn 
```

or

```bash
npm install
```

* Then, spin server and navigate to the browser **localhost:3000**

```bash
yarn dev
```

or 

```bash
npm run dev
```

### Testing application

Since we seeded the database with dummy data.

```bash
admin@mail.com  => 12345678
```


### Postman Collection

```bash
Book Manager.postman_collection.json
```




