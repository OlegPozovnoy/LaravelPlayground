 <?php

 use App\Post; // importing our model
use App\User;
 use App\Country;
 use App\Photo;
 use App\Tag;
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

//Route::resource('posts','PostController');


 Route::group(['middleware' =>['web']], function(){


});


 Route::get('contact','PostController@contact');


 //Route::get('post/{id}/{name}', 'PostController@show_post');


 Route::get('/insert', function(){

     DB::insert('insert into posts(title, body) values(?,?)',['Another post about PHP with Laravell', 'Laravel est numero uno']);
    return "the row has been inserted";
 });


 Route::get('/read', function(){
    // $results = DB::select('select * from posts where id = ?',[1]);
     $results = DB::select('select * from posts');
       return var_dump($results);
 });



 Route::get('/update', function(){

    //way #2
     Post::where('id',2)->where('is_admin',0)->update(['title' => 'New php title', 'body'=> 'new Body']);

    //way#1
     //$updated = DB::update('update posts set title = "Updated tited" where id = ?',[1]);
    //return $updated;// is success
 });


 Route::get('/delete', function(){

     //way #1
    //$deleted = DB::delete('delete from posts where id = ?',[1]) ;
    //return $deleted;//is success

     $post = Post::find(1);
     $post->delete();

 });


 Route::get('/delete2', function(){

      Post::destroy([2,3,5]); //delete by id
 });

 // ELOQUENT

 Route::get('/find',function(){

    // $posts = Post::all();
    $posts = Post::find(2);
    return var_dump($posts->title);
    // foreach($posts as $post){
    //     return $post->title;
    // }

 });

 Route::get('/findwhere', function(){

     $posts = Post::where('id',2)->orderBy('id','desc')->take(1)->get();

    // $posts = Post::where()->orderBy('id','desc')->take(1)->get();

     return $posts;

 });


 Route::get('/findmore', function(){

     $posts = Post::findOrFail(1);
     $posts = Post::where()->orderBy('id','desc')->take(1)->get();
    $posts = Post::where('users_count', '<',50)->firstOrFail();
     return $posts;

 });



 Route::get('/basicinsert',function(){

    //$post =  new Post;
     $post = Post::find(2);
    $post->title = 'test title to update 2';
    $post->body = 'test body to update 2';
    $post->save();
 });

 Route::get('/create',function(){

     Post::create(['title'=>'the create method', 'body' =>'SDFWEFWEFEWFEF']);

 });


 Route::get('/softdelete', function(){

    Post::find(3)->delete();

 });

 Route::get('/readsoftdelete', function(){

     $post = Post::find(3);

     //$post = Post::withTrashed()->where('id',3)->get();
    //withTrashed doesnt exist ?!
     $post = Post::onlyTrashed()->where('id',3)->get();

     return $post;

 });

 Route::get('/restore',function(){

     Post::withTrashed()->where('is_admin',0)->restore();


 });


 Route::get('/forecedelete',function(){

    Post::onlyTrashed()->where('id',2)->forceDelete();
 });


 Route::get('/user/{id}/post',function($id){

    return User::find($id)->postt;
 });


 Route::get('/post/{id}/user',function($id){

     return Post::find($id)->userrr->name;

 });


 Route::get('/posts',function(){

     $user = User::find(1);

     foreach($user->posts as $post)
     {
         echo $post->title."<br>";

     }
 });



 Route::get('/user/{id}/role',function($id){

     $user = User::find($id)->roles()->orderBy('id','desc')->get();

     return $user;
    //    foreach ($user->roles as $role)
    //        echo $role->name;


 });


 Route::get('user/pivot',function(){

     $user = User::find(2);
     foreach($user->roles as $role)
     {
         echo $role->pivot->created_at;

     }

 });


 Route::get('/user/country',function(){

     $country = Country::find(1);

     foreach($country->posts as $post)
         return $post ;

 });


 Route::get('user/photos',function(){

     $user = User::find(1);
     foreach($user->photos as $photo){

         return $photo;
     }

 });

 Route::get('photo/{id}/post',function($id){

     $photo = Photo::findOrFail($id);

     return $photo->imageable;

 });


 Route::get('/post/tags',function(){

    $post = Post::find(1);

    foreach($post->tags as $tag){
        echo $tag->name;
    }
 });


 Route::get('/tag/post',function(){


     $tag = Tag::find(2);
     foreach($tag->posts as $post){

         echo $post;
     }

 });