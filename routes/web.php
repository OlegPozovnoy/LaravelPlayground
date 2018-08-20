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

    //return "helloworld.";
});


// Route::get('/about', function () {
//     //return view('welcome');
//
//     return "about page.";
// });


// Route::get('/contacts', function () {
//     //return view('welcome');
//
//     return "Contacts.";
// });


 //Route::get('/post/{id}/{name}', function($id, $name){

//    return 'Htisi is post# '.$id.$name;
// });


 //Route::get('admin/posts/example', array('as'=>'admin.home', function(){
 //   $url = route('admin.home');

 //   return $url;
    // return 'Htisi is post# '.$id.$name;
// }));


 //Route::get('/post/{id}', 'PostController@index');

Route::resource('posts','PostController');


 Route::group(['middleware' =>['web']], function(){


});


 Route::get('contact','PostController@contact');


 Route::get('post/{id}/{name}', 'PostController@show_post');