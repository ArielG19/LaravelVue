<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //
   	protected $table = 'posts';
    protected $fillable = ['title','image'];
        //Query Scope
    /*public function scopeName($query, $title)
    {
        if($title)
        	//%% hacen que incluya todo lo que comience y termine con la palabra.
            return $query->where('title', 'LIKE', "%$title%");
    }*/

}
