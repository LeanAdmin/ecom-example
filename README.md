# Example Lean app

This is an example app for Lean Admin. It can serve as a reference for whenever you want to see something in practice rather than reading docs, or as a good starting point to first play with Lean before implementing it from scratch.

You may find a live demo here: https://demo.lean-admin.dev/admin

All of the Lean-related files can be found in the [`app/Lean` directory](https://github.com/LeanAdmin/ecom-example/tree/master/app/Lean).

## Installation

> This demo was originally created for Lean customers, but I decided to open it for others as well — so that they can see how an app written with Lean looks like. So, feel free to look around the codebase, but be aware that the composer installation won't work if you don't have access to the Lean repo.

1. `git clone` the repository
2. `cp .env.example .env`
3. `composer install`
4. `touch database/database.sqlite` — create the database file (we're using SQLite for simplicity)
5. `php artisan migrate:fresh --seed` — this will generate quality data + 10 random users

Now you can visit the app in the browser, register, and then click *Admin Panel* in the dashboard's navigation menu. This will take you to the home page of your Lean admin panel.

## Features

This is a simple e-commerce application based on Jetstream. There's no customer-facing e-commerce application, but you may manipulate all of the e-commerce resources in your Lean admin.

Jetstream is used to demonstrate the `auth` protection of admin routes.

- Custom page showing statistics
- Custom Create Order action
- A simple e-commerce app
  - Orders
  - Products
  - Customers
  - Order Products
  - Users from Jetstream

You can try creating individual resources, or playing with the relations (e.g. creating a relation through hasMany: create an OrderProduct from an Order, the order ID will be filled in). Play with the search, validation, notifications.
