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

**Website UI**

1. Register

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Register.png?raw=true)

<br />

2. Login

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Login.png?raw=true)

<br />

3. Reset Password (mailtrap)

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Reset%20Password.png?raw=true)

<br />

4. Home Dashboard

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Home%20Dashboard.png?raw=true)

<br />

5. All Category (index)

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Index%20Categories.png?raw=true)

<br />

6. Create New Category

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Create%20New%20Category.png?raw=true)

<br />

7. Detail Category

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Detail%20Category.png?raw=true)

<br />

8. Edit Category

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Edit%20Category.png?raw=true)

<br />

9. All Post (index)

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Index%20Posts.png?raw=true)

<br />

10. Create New Post

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Create%20New%20Post.png?raw=true)

<br />

11. Detail Post

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Detail%20Post.png?raw=true)

<br />

12. Edit Post

![alt text](https://github.com/Darkgaze-Tech/VIX-Investree-Fullstack-Franky/blob/public/image/Edit%20Post.png?raw=true)

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
