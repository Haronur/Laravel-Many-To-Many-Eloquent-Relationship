<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Laravel Many To Many Relationship Example From Scratch

#### Step 1. Basic Configuration
- For creating a new project, new need to run the below command in your terminal, laravel new laramanytomany
- Now, we need to connect this newly created laravel project with the database.
- Go to your database administration tool ( `sequel pro, phpMyAdmin etc.` ) and make a new database and give it a name `laramanytomany`
- To connect database and laravel project each other, we should change the .env file of project.
- Open your editor and change the below lines in `.env` file.
- Customize at `AppServiceProvider.php` in `project\app\Providers`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laramanytomany
DB_USERNAME=root
DB_PASSWORD=
```
- Various fields are host number, port number, database name, username, password etc.
- Change these fields as per your computer configurations and now you have connected your database and laravel project.

#### Step 2. Making Roles and Pivot Table
- In this example, we will use total of three tables. One table users will be defined by laravel system automatically, so we neede to create two tables manually, one is roles and another is `role_user`
- Run the following command in the terminal
`php artisan make:migration create_roles_table`
- After this, run below command in the terminal
`php artisan make:migration create_role_user_table`
- After successful execution of both of these commands, system will create two migration files.
- Go to `database->migrations` directory and open `timestamp_create_roles_table.php file.`
- Write down the below source code in `timestamp_create_roles_table.php` file.
```
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
```
- This migration file is for roles table. up() function in the above file includes the column names for roles table.
- Now in the same directory, there is another migration called `timestamp_create_role_user_table.php` file.
- Following is the source snippet for `timestamp_create_role_user_table.php` file.
```
<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
```
- Same as previous migration file, up() method have column names for `role_user` table.
- A column `user_id` is referencing id from the users table.
- While `role_id` is representing the id from the roles table.
- Now run the below command in terminal.
`php artisan migrate`
- This command will create tables like users, roles, role_user, migrations etc.

#### Step 3. Writing Models

- We require three model classes in this example.
- Model for users table `User.php` is already created by system. We will create other two like `Role.php` and `UserRole.php`
- Before that, let us first add some required lines in `User.php` file `( app->User.php )`.
- Final source code for `User.php` file should be like the below
```
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

}
```
- I have added roles() function in the above file. Other functions are already written by laravel system.
- `roles()` function includes `belongsToMany()` method. This method is telling compiler that a roles table’s row can have relationship with multiple rows of users table.
- Here,  `belongsToMany()` method is taking the help of pivot table role_user to define many to many relationship.
- Now let us create necessary model file. Run the following command first,

`php artisan make:model Role`
- It will make a new model file `Role.php`
- Open Role.php which is located at `app->Role.php` and add the following source snippet in it
```
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
```
- Read the users() functions in above code.

- It also includes the `belongsToMany()` method. This method is defining many to many relationship of users table using the Pivot table `role_user`.
- Now run the below command
`php artisan make:model UserRole`
- It will make a model named “UserRole.php” and code for this file is as the following
```
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
}
```

#### Step 4. Adding Rows in Database

- Let us some records in our database. Just see the below image and add rows as per the image.
- Laravel Many To Many Relationship
- In the above image, users table is located at the top. Middle table is pivot table, `role_user` and at the bottom there is roles table.
- Add three user names John, Ronald and Gary in users table.
- Insert three roles as Admin, Editor and Reader in roles table.
- Pivot table role_user consists the relationship data between users and roles tables. It uses `user_id` and `role_is` to define many to many relationship between these two tables.

#### Step 5. Making New Controller and Route
- Navigate to `routes->web.php` file and add the below line in it
`Route::get('manyrole','ManyController@manyRoles');`
- When user run http://127.0.0.1:8000/manyrole URL in browser, system will trigger the above route.
- This route will call m`anyRoles()` method from `ManyController.php` file.
- Now let us make a controller file `ManyController.php`
- First of all, run the below command
`php artisan make:controller ManyController`
- You will find a `ManyController.php` file inside `app->Http->Controllers` directory after triggering above command.
- Write the following source lines in `ManyController.php` file
```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class ManyController extends Controller
{
    public function manyRoles()
    {
        $user = User::find(1);
        $role = Role::find(3);
        return view('index',compact('user','role'));
       
    }
}
```
- Only one function `manyRoles()` is there.
- First line in this function will fetch all the rows from the roles table which is played by the user_id = 1 in pivot table.
- Similarly, second line will get all the records from users table who have played role_id = 3 in pivot table.
- For more understandings, see the above image which have all three tables one by one.
- At last, function will return the compiler to the view file called “index.blade.php” along with two variables.

#### Step 6. Blade File and Done
- Our last step is to create blade view file.
- Go to resources->views directory and make a new file `index.blade.php`
- Write down the following code snippet in this view file.
```
<html>
<head>
   
</head>
<style>
  
</style>
<body>
 
<h1> Laravel Many to Many Example </h1>
<h2> User 1 (John) is playing below Roles

@if ($user->roles->count() > 0)
  <ul>
  @foreach($user->roles as $records)
    <li>{{ $records->role_name }}</li>
  @endforeach
  </ul>
@endif

<h2> Role 3 (Reader) is played by below Users

@if ($role->users->count() > 0)
  <ul>
  @foreach($role->users as $records)
    <li>{{ $records->name }}</li>
  @endforeach
  </ul>
@endif

</body>
</html>
```
- Run this below command, After Creating DB seeder on your Project:
 ```
 php artisan db:seed
 php artisan serve
 ```
- We are using those two variables which we have passed in the return statement in manyRoles() function of controller file.
- two foreach loops are created using these variables.
- In every iteration of first foreach loop, we will print role name. Similarly, in the second foreach loop , system will print the role name in every iteration.
- So, it was all about laravel many to many relationship tutorial with example.

## Laravel 7 Database Seeder Example
- In this Section, i will show you how to create database seeder in laravel 7 and what is command to create seeder and how to run that seeder in laravel 7. so you have to just follow few step get how it's done.
- Laravel gives command to create seeder in laravel. so you can run following command to make seeder in laravel application.
- Create Seeder Command:
```
php artisan make:seeder UserSeeder
php artisan make:seeder RoleSeeder
php artisan make:seeder UserRoleSeeder
```
- after run above commands, it will create three files `UserSeeder.php`, `RoleSeeder.php`, `UserRoleSeeder.php` on seeds folder. All seed classes are stored in the database/seeds directory.
- Then you can write code of create admin user using model in laravel.

- `database/seeds/AdminUserSeeder.php`
```
<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John',
            'email' => 'John@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Ronald',
            'email' => 'Ronald@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Gary',
            'email' => 'Gary@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
```
- `database/seeds/RoleSeeder.php`
```
<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create([
            'role_name' => 'Admin'
        ]);

        App\Role::create([
            'role_name' => 'Editor'
        ]);

        App\Role::create([
            'role_name' => 'Reader'
        ]);
    }
}
```
`database/seeds/UserRoleSeeder.php`
```
<?php

use Illuminate\Database\Seeder;
use App\UserRole;
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'user_id' => 1,
            'role_id' => 1
        ]);
        UserRole::create([
            'user_id' => 1,
            'role_id' => 2
        ]);
        UserRole::create([
            'user_id' => 2,
            'role_id' => 3
        ]);
        UserRole::create([
            'user_id' => 1,
            'role_id' => 3
        ]);
        UserRole::create([
            'user_id' => 3,
            'role_id' => 3
        ]);
    }
}
```

## Way 1: Run Single Seeder
```
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=UserRoleSeeder
```

##  Way 2: Run All Seeders
- In this way, you have to declare your seeder in DatabaseSeeder class file. then you have to run single command to run all listed seeder class.
- So can list as bellow:
- `database/seeds/DatabaseSeeder.php`
```
<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserRoleSeeder::class);
    }
}
```
- Now you need to run following command for run all listed seeder:
`php artisan db:seed`

#### If you want to rollback and rerun all migrations, and then reseed:
- `$ php artisan migrate:refresh --seed`
- The migrate:refresh --seed command is a shortcut to these 3 commands:
```
    $ php artisan migrate:reset     # rollback all migrations
    $ php artisan migrate           # run migrations
    $ php artisan db:seed           # run seeders
```
- Now i think you will understand how seeding is work and we have to use in our laravel app.
- I hope it can help you...

