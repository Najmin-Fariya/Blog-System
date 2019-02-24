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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/search','SearchController@search')->name('search');

Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{username}','AuthorController@authorProfile')->name('author.authorProfile');
Route::post('subscriber','SubscriberController@store')->name('subscriber.store');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    
    Route::get('/settings','SettingsController@index')->name('settings');
    Route::put('/profile-update','SettingsController@updateProfile')->name('profile.update');
    Route::put('/password-update','SettingsController@updatePassword')->name('password.update');
    
    Route::get('/pending/post','PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve','PostController@approval')->name('post.approve');
    
    Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{subscriber}','SubscriberController@destroy')->name('subscriber.destroy');
    
    Route::get('/favourites','AdminFavouriteController@index')->name('favourite.index');
    
    Route::get('/authors','AuthorController@index')->name('authors.index');
    Route::delete('/authors/{id}','AuthorController@destroy')->name('authors.destroy');

    Route::get('/comments','AdminCommentController@viewComment')->name('comment.viewComment');
    Route::delete('/comments/{id}','AdminCommentController@destroy')->name('comment.destroy');
    

});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function () {
    Route::get('/dashboard', 'AuthorDashboardController@index')->name('dashboard');
    Route::resource('post', 'AuthorPostController');
    
    Route::get('/authorSettings', 'AuthorSettingsController@index')->name('authorSettings');
    Route::put('/profile-update','AuthorSettingsController@updateProfile')->name('profile.update');
    Route::put('/password-update','AuthorSettingsController@updatePassword')->name('password.update');
    
    Route::get('/favourite','AuthorFavouriteController@index')->name('favourite.index');
    
    Route::get('/comments','AuthorCommentsController@viewComment')->name('comment.viewComment');
    Route::delete('/comments/{id}','AuthorCommentsController@destroy')->name('comment.destroy');
    
});

    Route::group(['middleware'=>['auth']],function(){
    Route::post('favourite/{post}/add','FavouriteController@add')->name('post.favourite');
    Route::post('comment/{id}','CommentController@store')->name('comment.store');
    

});

//Route::get('/comments','CommentController@store')->name('comment.viewComment');

Route::get('post/{slug}','PostDetailsController@details')->name('post.details');
Route::get('all-posts/','AllPostController@allPosts')->name('view.allPost');

Route::get('category/{slug}/','AllPostController@postsByCategory')->name('category.posts');
Route::get('tag/{slug}/','AllPostController@postsByTag')->name('tag.posts');




