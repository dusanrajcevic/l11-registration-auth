# REGISTRATION / LOGIN SYSTEM</h1>
## Table of Contents
- [Task description](#task-description)
- [Task requirements](#task-requirements)
- [Introduction](#introduction)
  - [Deployment](#deployment)
- [ANSWER - SECURITY](#answer---security)
---
## Task description
1. Сreate a user registration form that consists of the following input fields:
    * Username
    * Email
    * Password
    * Password confirmation
    * Agreement checkbox
    * Register button
2. Save user data in the database.
3. Create a login form where the user can log in to the system.

## Task Requirements
1. Use Laravel Framework and MySQL database.
2. Tell us a few ways how you would make the registration form more secure. Do you have any preferred approach? If yes, why is it preferred?
---

## Introduction

This small demo app is written in Laravel 11 using MySQL as a database management system.

It covers custom implementation of registration and authentication of users.

Blade files are used for the UI.

The app is built with TDD approach in mind, using PhpUnit as a testing framework for unit and feature tests that cover most of the cases in the app.

Directory structure and class autodiscovery hasn't been changed from the default one coming with Laravel.

No external packages have been used.

### Deployment
#### System requirements

Since the project is built on top of Laravel 11 framework, all requirements can be found in the official Laravel's [documentation](https://laravel.com/docs/11.x/deployment#server-requirements).

#### Local installation

1. Clone the repository to your local machine.
2. From the terminal, navigate to the project directory.
3. Copy the `.env.example` file to `.env` and update your environment settings:
```bash
cp .env.example .env
php artisan key:generate
```
4. Run the development server:
```bash
php artisan serve
```
5. Open the URL you see in the browser (for example http://localhost:8000)

----------
## Answer - security
Registration form implements basic security measures such as rate limiting on form submissions, CSRF protection, data validation on the server side, protection against SQL injection by using Laravel's Eloquent User model to store data, and hashing passwords in the database. System also makes sure users are verified by clicking on a link sent to their e-mail before they are given access to the system.

We could add a few more layers of protection such as implementing ReCAPTCHA to prevent bots from submitting unlimited requests via registration form. We could even use a more sophisticated service such as Cloudflare or Datadome which offer advanced bot mitigation solutions with a wide range of automated threats protection.

Additionally, we would aim to offer users to authenticate and register via OAuth providers such as Google, Facebook, Linkedin, X, etc. by using Socialite, a first-party package from Laravel. All of these providers already have their own means of user verification, so reliance on their knowledge can potentially decrease the number of bot users to the minimum.

To go one step further, we would ask users to provide proof of their identity with an ID document and a real time photo taken by the device's camera that could be verified using services such as Checkin, BlueCheck or iDenfy that use AI to compare them automatically.

---

