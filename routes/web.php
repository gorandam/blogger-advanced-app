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

//RESTfull controller CRUD
Route::get('/tickets', [ // route to DISPLAY ALL tickets
  'uses' => 'TicketsController@index',
  'as' => 'tickets.index'
]);

Route::get('/contact', [ // route to DISPLAY FORM to insert tickets
  'uses' => 'TicketsController@create',
  'as' => 'tickets.create'
]);

Route::post('/contact', [// route to STORE tickets
  'uses' => 'TicketsController@store',
  'as' => 'tickets.create'
]);

Route::get('/ticket/{slug?}', 'TicketsController@show');// route to SHOW specified ticket
Route::get('/ticket/{slug?}/edit', 'TicketsController@edit');// route to DISPLAY EDIT FORM to update the tickets
Route::post('/ticket/{slug?}/edit', 'TicketsController@update');// route to UPDATE tickets into the database
Route::post('/ticket/{slug?}/delete', 'TicketsController@destroy');// route to DELETE tickets  into the database
// Create Email route
Route::get('sendemail', function () {
  $data = array( 'name' => "Laravel Freak");
  Mail::send('emails.welcome', $data, function ($message) {// three argumets: view php template, $data (to pased data to php template, closure)
    $message->from('goran.dam@gmail.com', 'Laravel Freak');
    $message->to('goran.dam@gmail.com')->subject('Learning Laravel test email');
  });
  return "Your email has been sent successfully";
});

// We create Routes for CommentsController for handling form submossion and save comments to the database
Route::post('/comment','CommentsController@newComment');//When we send post request to this route Laravel will execute CoommentsControllers newComment acction

// Here we create routes for registration of our users
Route::get('users/register', 'Auth\RegisterController@showRegistrationForm');//route to DISPLAY registration form
Route::post('users/register', 'Auth\RegisterController@register');//route to process the form

//Here is route to logout our user
Route::get('users/logout', 'Auth\LoginController@logout');//route to logout users

// Here we create routes for login our users
Route::get('users/login', 'Auth\LoginController@showLoginForm')->name('login');// route do DISPLAY login form // we specified named route and we use it when redirect via global redirect function
Route::post('users/login', 'Auth\LoginController@login');// route to process login form

//Admin area routes
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {
  Route::get('users', 'UsersController@index');
});
