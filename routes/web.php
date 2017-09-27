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
Route::post('/comment',[ //When we send post request to this route Laravel will execute CoommentsControllers newComment acction
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

//Admin area routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['manager']], function () { //Here we have a namespace admin, with this Laravel know where to find classes namespaded as Admin
  Route::get('users', [// Route to list all users
    'uses' => 'UsersController@index',
    'as' => 'backend.users.index'
  ]);
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
  Route::get('users/{id?}/edit', [ // Route to create view to edit users
    'uses' => 'UsersController@edit',
    'as' => 'backend.users.edit'
  ]);
  Route::post('users/{id?}/edit', [ // Route to update users
    'uses' => 'UsersController@update',
    'as' => 'backend.users.update'
  ]);
});
