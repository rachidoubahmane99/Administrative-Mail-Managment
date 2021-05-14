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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'FirebaseAuth@LoginForm')->name("login");
Route::post('/login', 'FirebaseAuth@Logincheck')->name("login.check");
Route::post('/logout', 'FirebaseAuth@logout')->name("logout");
Route::get('/register', 'FirebaseAuth@RegisterForm')->name("register");
Route::post('/register', 'FirebaseAuth@Registercheck')->name("register.check");


Route::group([
    'middleware' => 'AdminAuth',
], function () {

    Route::get('/users', 'UserController@index')->name('users');
    // Route::get('/users1', 'UserController@getDocument');
    Route::get('/users/create', 'UserController@create');
    Route::post('/users/store', 'UserController@store');
    Route::get('/users/edit/{id}', 'UserController@edit');
    Route::put('/users/update/{id}', 'UserController@update');
    Route::get('/users/delete/{id}', 'UserController@destroy');
    
// admins routes 
Route::get('/admins', 'AdminController@index');
// Route::get('/users1', 'UserController@getDocument');
Route::get('/admins/create', 'AdminController@create');
Route::post('admins/store', 'AdminController@enregistrer')->name('admins.store');
Route::get('/admins/edit/{id}', 'AdminController@edit');
Route::put('/admins/update/{id}', 'AdminController@update');
Route::get('/admins/delete/{id}', 'AdminController@destroy');

//  mails routes

Route::get('/mails', 'MailsController@index')->name('emails.index');
// Route::get('/eml', 'MailsController@index');
Route::get('/justfortest', 'MailsController@tst');
Route::get('/emails/create', 'MailsController@create');
Route::post('/emails/store', 'MailsController@store');
Route::get('/emails/delete/{id}', 'MailsController@destroy');
Route::get('/emails/show/{id}', 'MailsController@show');
Route::get('/emails/replay/{id}', 'MailsController@showreplay');
Route::get('/emails/encours', 'MailsController@encours');
Route::get('/emails/traited', 'MailsController@traited');
Route::get('/emails/notTraited', 'MailsController@notTraited');
// this is only for test
Route::get('file', 'MailsController@thisme');
Route::post('/emails/store2', 'MailsController@store2');

// Departements Routes

Route::get('/departements', 'DepartementsController@index');
// Route::get('/users1', 'UserController@getDocument');
Route::get('/departements/create', 'DepartementsController@create');
Route::post('/departements/store', 'DepartementsController@store');
Route::get('/departements/edit/{id}', 'DepartementsController@edit');
Route::put('/departements/update/{id}', 'DepartementsController@update');
Route::get('/departements/delete/{id}', 'DepartementsController@destroy');
});




Route::group([
    'middleware' => 'UserAuth',
], function () {
    Route::get('user/mails', 'UserMailsController@index')->name('user.mails');
    Route::get('user/emails/encours', 'UserMailsController@encours');
    Route::get('user/emails/traited', 'UserMailsController@traited');
    Route::get('user/emails/notTraited', 'UserMailsController@notTraited');
    Route::get('user/emails/replay/{id}', 'UserMailsController@Replay');
    Route::post('user/emails/replay/store', 'UserMailsController@store');
    Route::get('user/emails/show/{id}', 'UserMailsController@show');
    Route::get('user/emails/replay/show/{id}', 'UserMailsController@showreplay');
    Route::get('user/emails/traiter/{id}', 'UserMailsController@traiter');
    
 

});   
//Route::get('/firebase', 'FirebaseController@index');
//Route::get('/home', 'HomeController@index');
//Route::get('/home/create', 'HomeController@create');
//Route::get('/home/{id}/edit', 'HomeController@edit');
//Route::get('/home/{id}/destroy', 'HomeController@destroy');
//Route::get('/firestore', 'FirestoreController@index');
//Route::get('/firestore/create', 'FirestoreController@create');
//Route::get('/firestore/{id}/edit', 'FirestoreController@edit');
//Route::get('/firestore/{id}/destroy', 'FirestoreController@destroy');
//Route::get('/firestore/show', 'FirestoreController@show');
// Route::get('/login_Test', 'LoginController@test');




