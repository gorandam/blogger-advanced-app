<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//dd(app('App\Billing\Stripe'));// Here we die and dump it to the browser page

Route::get('/', [
  'uses' => 'PagesControler@home',
  'as' => 'home'
]);

Route::get('/about', [
  'uses' => 'PagesControler@about',
  'as' => 'about'
]);

//RESTfull Tickets controller CRUD
Route::get('/tickets', [ // route to DISPLAY ALL tickets
  'uses' => 'TicketsController@index',
  'as' => 'tickets.index'
]);

//Insert ticket routes
Route::get('/contact', [ // route to DISPLAY FORM to insert tickets
  'uses' => 'TicketsController@create',
  'as' => 'tickets.create'
]);
Route::post('/contact', [// route to STORE tickets
  'uses' => 'TicketsController@store',
  'as' => 'tickets.create'
]);

Route::get('/ticket/{slug?}', [ // route to SHOW specified ticket
  'uses' => 'TicketsController@show',
  'as' => 'tickets.show'
]);

//Edit ticket routes
Route::get('/ticket/{slug?}/edit', [// route to DISPLAY EDIT FORM to update the tickets
  'uses' => 'TicketsController@edit',
  'as' => 'tickets.edit'
]);
Route::post('/ticket/{slug?}/edit', [// route to UPDATE tickets into the database
  'uses' => 'TicketsController@update',
  'as' => 'tickets.edit'
]);

Route::post('/ticket/{slug?}/delete', [ // route to DELETE tickets  into the database
  'uses' => 'TicketsController@destroy',
  'as' => 'ticket.delete'
]);



// Create Email route to test our email configuration in env file
/*Route::get('sendemail', function () {
  //$data = array( 'name' => "Laravel Freak");
  Mail::send('emails.welcome', [ 'name' => "Advanced Blogger"], function ($message) {// three argumets: view php template, $data (to pased data to php template, closure)
    $message->from('hello.app@test.com', 'Laravel Freak');
    $message->to('goran.dam@mail.com')->subject('Learning Laravel test email');
  });
  return "Your email has been sent successfully";
});
*/

// We create Routes for COMENTSCONTROLLER for handling form submssion and save comments to the database
Route::post('/comment',[ //When we send post request to this route Laravel will execute CoommentsControllers  now $form->persist()
  'uses' => 'CommentsController@newComment',
  'as' => 'comment.edit'
]);

// Here we create routes for registration of our users
Route::get('users/register', [ //route to DISPLAY registration form
  'uses' => 'Auth\RegisterController@showRegistrationForm',
  'as' => 'auth.register'
]);
Route::post('users/register', [ //route to process the form
  'uses' => 'Auth\RegisterController@register',
  'as' => 'auth.register'
]);

//Here is route to logout our user
Route::get('users/logout', [ //route to logout users
  'uses' => 'Auth\LoginController@logout',
  'as' => 'auth.logout'
]);

// Here we create routes for login our users
Route::get('users/login', [ // route do DISPLAY login form // we specified named route and we use it when redirect via global redirect function
  'uses' => 'Auth\LoginController@showLoginForm',
  'as' => 'auth.login'
]);
Route::post('users/login', [ // route to process login form
  'uses' => 'Auth\LoginController@login',
  'as' => 'auth.login'
]);

//Blog post display routes
Route::get('blog', [ // route to display all blog posts
  'uses' => 'BlogController@index',
  'as' => 'blog.index'
]);
Route::get('blog/{slug?}', [ // route to display all blog posts
  'uses' => 'BlogController@show',
  'as' => 'blog.show'
]);

//Admin area routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['manager']], function () { //Here we have a namespace admin, with this Laravel know where to find classes namespaded as Admin
  Route::get('users', [// Route to list all users
    'uses' => 'UsersController@index',
    'as' => 'backend.users.index'
  ]);

  //Roles routes
  Route::get('roles', [ //Route to list all roles
    'uses' => 'RolesController@index',
    'as' => 'backend.roles.index'
  ]);
  Route::get('roles/create', [ //Route to create view to store roles
    'uses' => 'RolesController@create',
    'as' => 'backend.roles.create'
  ]);
  Route::post('roles/create', [ //Route to store roles to the database;
    'uses' => 'RolesController@store',
    'as' => 'backend.roles.store'
  ]);
  Route::get('roles/{role?}', [ //Route to store roles to the database;
    'uses' => 'RolesController@show',
    'as' => 'backend.rolesusers.show'
  ]);

  //Users route
  Route::get('users/{id?}/edit', [ // Route to create view to edit users
    'uses' => 'UsersController@edit',
    'as' => 'backend.users.edit'
  ]);
  Route::post('users/{id?}/edit', [ // Route to update users
    'uses' => 'UsersController@update',
    'as' => 'backend.users.update'
  ]);

  //Pages route
  Route::get('/', [ // Route to get admin home page
    'uses' => 'PagesController@home',
    'as' => 'backend.home'
  ]);

  // Posts routes
  Route::get('posts', [ // Route to get all posts
    'uses' => 'PostsController@index',
    'as' => 'backend.posts.index'
  ]);

  Route::get('posts/create', [ // Route to get create form
    'uses' => 'PostsController@create',
    'as' => 'backend.posts.create'
  ]);

  Route::post('posts/create', [ // Route to store post
    'uses' => 'PostsController@store',
    'as' => 'backend.posts.store'
  ]);

  Route::get('posts/{post?}/edit', [ // Route to get edit form
    'uses' => 'PostsController@edit',
    'as' => 'backend.posts.edit'
  ]);

  Route::post('posts/{post?}/edit', [ // Route to update post
    'uses' => 'PostsController@update',
    'as' => 'backend.posts.update'
  ]);

//Categories Routes
  Route::get('categories', [ // Route to get all categories from the database
    'uses' => 'CategoriesController@index',
    'as' => 'backend.categories.index'
  ]);

  Route::get('categories/create', [ // Route to get new categories form
    'uses' => 'CategoriesController@create',
    'as' => 'backend.categories.create'
  ]);

  Route::post('categories/create', [ // Route to post categories form
    'uses' => 'CategoriesController@store',
    'as' => 'backend.categories.store'
  ]);

  Route::get('categories/{category?}', [ // Route to show all category posts
    'uses' => 'CategoriesController@show',
    'as' => 'backend.postscategories.index'
  ]);
});
