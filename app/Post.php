<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Here you can do most of the basic DB stuffs
class Post extends Model
{
  //when you create the model Post it automatically creates a table called posts(plural)
  //But you can change it if you want as below
    //Table name
    protected $table='posts'; //change the name of the table if you want to
    //Primary key
    public $primarykey='id'; //Change primary key field
    //Timestamps
    public $timestamps='true'; //false change if you want

    // Creating relationship
    // Basically means a post has a relationship with a user and belongs to a user
    public function user(){
      return $this->belongsTo('App\User');
    }
}
