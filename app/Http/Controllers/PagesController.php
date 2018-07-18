<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
  /**
  * These methods are used to display views/pages that are created in the views>pages folder
  */
    public function index(){
      $title="Welcome to Laravel Wayne Gakuo!";
      // return view ('pages.index', compact('title')); //gonna go to the view folder check for pages>index.blade.php and display
      return view ('pages.index')->with('title', $title); //best esp if you are working with arrays
    }
    public function about (){
      $title="About Us";
      return view ('pages.about')->with ('title', $title);
    }
    public function services (){
      $data= array(
        'title' =>'Services',
        'services' =>['Web Design', 'Programming', 'SEO']
      ); //an associative array; key-value pair
      return view ('pages.services')->with($data);
    }
    // public function login(){
    //   $title="Login";
    //   // return view ('pages.index', compact('title')); //gonna go to the view folder check for pages>index.blade.php and display
    //   return view ('pages.login')->with('title', $title); //best esp if you are working with arrays
    // }
    // public function register(){
    //   $title="Register";
    //   // return view ('pages.index', compact('title')); //gonna go to the view folder check for pages>index.blade.php and display
    //   return view ('pages.register')->with('title', $title); //best esp if you are working with arrays
    // }
}
