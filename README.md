# Sunrise Mini Library Management

This is a mini library management project written with laravel, inertia and others(described below). A showcase for what I can do with laravel.

## Table of contents

- [Screenshot](#screenshot)
- [Builtwith](#built-with)
- [RunLocally](#run-locally)
- [Author](#author)

### Screenshots

### Dashboard

![Alt](/screenshots/dashboard.png "Dashboard")

_______________________________________________________________

### Books

![Alt](/screenshots/books.png "Books")

_______________________________________________________________

### Loans

![Alt](/screenshots/loans.png "Loans")


### Built with

- Tailwind Css
- Laravel
- Inertia Js
- [Vue](https://vuejs.org/) - JS library

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