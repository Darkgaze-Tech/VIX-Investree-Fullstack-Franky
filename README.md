## Laravel Blog Project

Description project: Simple blog project using laravel framework to create API and Website UI.<br /><br />




**Restful API using Laravel Passport**

Tested using Postman

Feature list:
1. Register user [POST]
2. Login & logout user [POST]
3. Create category [POST]
4. Create post [POST]
5. Read category (all and single category) [GET]
6. Read post (all and single post) [GET]
7. Update category [PUT/PATCH]
8. Update post [PUT/PATCH]
9. Delete category [DELETE]
10. Delete post [DELETE]

<br />

**Laravel Blade and Laravel UI**

Feature list:
1. Laravel UI authentication
2. Register & login user  
3. Forgot password
4. CRUD template view of category & post

<br />

**Installation of laravel**

Go to the documentation link below:<br />
[Installation - Laravel - The PHP Framework For Web Artisanshttps://laravel.com › docs › 9.x › installation](https://laravel.com/docs/9.x/installation)

<br />

**Run Project**

Run project using command:

```
php artisan serve
```

<br />

**User Seed**

1. Generate user seed using command:

```
php artisan migrate:refresh --seed
```

<br />

2. Install passport after migrate refresh database

```
php artisan passport:install
```

<br />

**Unit Test**

Optionally, you can run unit test on this project using command:

```
php artisan test
```
