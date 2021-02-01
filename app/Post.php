<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    protected $fillable = ['title','content'];
    use SoftDeletes;
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function toTagString(){
        $tagTitle = [];
        foreach($this->tags as $tag){
            $tagTitle[] = $tag->title;
        }
        $tagTitleString = implode(',',$tagTitle);
        return $tagTitleString;
    }
}
