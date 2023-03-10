# Sunrise Mini Library Management

This is a mini library management project written with laravel, inertia and others(described below). A showcase for what I can do with laravel. The table of contents below contains more information about the project.

**Note**
The project is not responsive(only work for laptop or desktop).
It should work properly on chrome. I haven't test all the aspects yet.
I haven't test the project on firefox, so there may be some errors on firefox.

## Table of contents

- [Screenshot](#screenshot)
- [Builtwith](#built-with)
- [Features](#features)
- [RunLocally](#run-locally)
- [Author](#author)

## Screenshots

### Dashboard

![Alt](/screenshots/dashboard.png "Dashboard")

_______________________________________________________________

### Books

![Alt](/screenshots/books.png "Books")

_______________________________________________________________

### Loans

![Alt](/screenshots/loans.png "Loans")


## Built with

- [Tailwind CSS](https://tailwindcss.com/) - CSS Framework
- [Laravel](https://laravel.com/) - PHP Framework
- [Inertia js](https://inertiajs.com/)
- [Vue](https://vuejs.org/) - JS library

## Features

- authors (CRUD)
- books (CRUD)
- categorys (CRUD)
- fines (CRUD)
- members (CRUD)
- loans (CRUD)
- return book

## Run Locally

Clone the project

```bash
  git clone https://github.com/arkarsoeDev/sunrise-inertia.git
```

Go to the project directory

```bash
  cd sunrise-inertia
```

Install dependencies

```bash
  composer install
  npm install
```

Create Database file in database folder

```bash
  database/database.sqlite
```

Copy env file

```bash
  copy .env.example .env
```

Change env setting as below

```bash
  DB_CONNECTION=sqlite
```

Create key for project

```bash
  php artisan key:generate
```

Migrate and seed

```bash
  php artisan migrate:fresh --seed
```

Build the project

```bash
  npm run build
```

Run the project

```bash
  php artisan serve
```

## Author

- Github - [@arkarsoeDev](https://github.com/arkarsoeDev)
- Portfolio - [arkarsoe.netlify.app](https://arkarsoe.netlify.app/)