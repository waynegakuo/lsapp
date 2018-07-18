<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB; //if you wanna use mysql query to do your fetching
use Illuminate\Support\Facades\Storage; //will assist us in helping to use the storage functionalities for use

class PostsController extends Controller
{

  /**
   * Create a new controller instance.
   * Whichever page where the auth() is run, the user will be required to sign in unless exempted
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth', ['except'=>['index', 'show']]);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts= Post::orderBy('title','desc')->get(); //you can order how you want your posts
        //return Post::where('title', 'Post Two')->get();//you can request for what you want
        // $posts= DB::select('SELECT * FROM posts'); //f you wanna use mysqlquery
        // $posts= Post::orderBy('title','asc')->take(1)->get(); //if you want to limit
        //$posts= Post::all();
        //pagination by 1 post at time and links are in the posts>index
        $posts= Post::orderBy('updated_at','desc')->paginate(10);
        return view ('posts.index')->with ('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //Handle File Upload
      if($request->hasFile('cover_image')){
        //Get file name with the extension
        $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
        //Get just the file name
        $fileName=pathinfo($fileNameWithExt, PATHINFO_FILENAME); //this is just php

        //Get just the extension
        $extension=$request->file('cover_image')->getClientOriginalExtension(); //this is laravel

        //file name to Store
        //the concatenation will make the upload unique because of the time stamp
        $fileNameToStore=$fileName.'_'.time().'_'.$extension;
        //Upload image
        $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
      }
      else{
        $fileNameToStore='noImage.jpg'; //if not uploaded, it is just going to see this and upload
      }

      //validate the request with the array of rules that follow
        $this-> validate($request,[
          'title'=>'required',
          'body'=>'required',
          'cover_image'=>'image|nullable|max:1999'
        ]);
        //create post
        $post= new Post;
        $post->title= $request-> input('title'); //the title name carrying the info and input into the DB
        $post->body= $request-> input('body'); //body name carries the info and input into the DB
        $post->user_id= auth()->user()->id; //the user id will be added
        $post->cover_image=$fileNameToStore; //the fileName is stored
        $post->save();

        //redirecting and sending with it a success message as per the message file we created
        return redirect('/posts')->with('success', 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postId= Post::find($id);
        //  Goes with the name of the table and the variable name(postID)
        // the post (singular here) should go hand in hand with the variable in
        // show.blade.php which calls on title from the DB to display
        //the $id dictates what content is to be carried
        return view ('posts.show')->with('post',$postId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //same with what we did for find but go to edit view
        $postId= Post::find($id);

        //Check for correct users
        //in the controller, we can access the user's id with auth()->user()->id
        //if the user id is not equal to the user id in the post, throw an error
        //and redirect user to posts main page`
        if(auth()->user()->id !== $postId->user_id){
            return redirect ('/posts')->with('error','Unauthorized Access');
        }

        return view ('posts.edit')->with('post',$postId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //validate the request with the array of rules that follow
        $this-> validate($request,[
          'title'=>'required',
          'body'=>'required'
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
          //Get file name with the extension
          $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
          //Get just the file name
          $fileName=pathinfo($fileNameWithExt, PATHINFO_FILENAME); //this is just php

          //Get just the extension
          $extension=$request->file('cover_image')->getClientOriginalExtension(); //this is laravel

          //file name to Store
          //the concatenation will make the upload unique because of the time stamp
          $fileNameToStore=$fileName.'_'.time().'_'.$extension;
          //Upload image
          $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }
        //we get rid of else because we don't wanna replace it with  noImage

        //Update post; it finds it by id and makes the changes to DB
        $post= Post::find($id);
        $post->title= $request-> input('title'); //the title name carrying the info and input into the DB
        $post->body= $request-> input('body'); //body name carries the info and input into the DB
        if($request->hasFile('cover_image')){
          $post->cover_image=$fileNameToStore; //checking to see if the image has been changed
        }
        $post->save();

        //redirecting and sending with it a updated message as per the message file we created
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::find($id);

        //Check for correct users
        //in the controller, we can access the user's id with auth()->user()->id
        //if the user id is not equal to the user id in the post, throw an error
        //and redirect user to posts main page`
        if(auth()->user()->id !== $post->user_id){
            return redirect ('/posts')->with('error','Unauthorized Access');
        }
        if($post->cover_image !='noImage.jpg'){
          //Delete Image
          Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post Removed');
    }
}
