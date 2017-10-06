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

/*use App\Task;

Route::get('tasks', 'TasksController@index');
Route::get('tasks/{task}', 'TasksController@show');*/

/*Route::get('/tasks', function () {
  //$tasks = DB::table('tasks')->latest()->get();
  //return $tasks;
  $tasks = Task::all();
  return view('tasks.index', compact('tasks'));
});*/

/*Route::get('tasks/{task}', function ($id) {
  //$task = DB::table('tasks')->find($id);
  //dd($task); //tinker
  //$tasks = DB::table('tasks')->latest()->get();
  $task = Task::find($id);

  return view('tasks.show', compact('task'));
});*/

/*App::bind('App\Billing\Stripe', function(){
  return new \App\Billing\Stripe(config('services.stripe.secret'));
});*/

App::singleton('App\Billing\Stripe', function(){
  return new \App\Billing\Stripe(config('services.stripe.secret'));
});

//$stripe = App::make('App\Billing\Stripe');
/*$stripe = resolve('App\Billing\Stripe');

dd($stripe);*/

Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/create', 'PostsController@create');
Route::get('/posts/{post}', 'PostsController@show');
Route::post('/posts', 'PostsController@store');
Route::post('/posts/{post}/{comment}', 'CommentsController@store');

//Route::get('/register', 'AuthController@register');
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');
//Route::get('/login', 'AuthController@login');
Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

//Controller => PostsController
//Eloquent Model => Post
//migration => create.posts.table
