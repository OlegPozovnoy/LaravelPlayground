<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Post extends Model
{

    use SoftDeletes;

//public function __construct(){
//    parent::__construct();


//}
    //Post -> lovercase + s - tablename

protected $table = 'posts';
protected $primaryKey = 'id'; // redefine if the name is different


    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'body'
    ];
    //

    public function userrr(){

        return $this->belongsTo('App\User','user_id','id');
    }

    public function photos(){

        return $this->morphMany('App\Photo','imageable');
    }


    public function tags(){

        return $this->morphToMany('App\Tag','taggable');
    }

}
