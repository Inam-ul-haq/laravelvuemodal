<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Post;
// use App\Category;
use Image;
use DB;

class PostController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:api');
    }
  
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'description' => 'required',
        ]);

        $post = new Post([
            'title' => $request->get('title'),
            'description' => $request->get('description')
        ]);

        $post->save();

        return response()->json('successfully added');
    }
    public function index()
    {   
        // $posts = Post::find(1);
        //  $posts = $posts->categories;
        // dd($posts);

        return new PostCollection(Post::all());
    }


    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function update($id, Request $request)
    {       
            $post = Post::find($id);
            $this->validate($request, [
          // 'title' => 'required|max:255|unique:posts,title,' . $post->id,
             'title' => 'required|unique:posts|max:255|unique:posts,title,'. $post->id,
            'description' => 'required',
             ]);
        
        
        $post->update($request->all());

        return response()->json('successfully updated');
    }

    public function destroy($id)
    {
        
        $post = Post::find($id);

        $post->delete();

        return response()->json('successfully deleted');
    }
    public function view(){
        
    }


    public function FileUpload(Request $request){
     $this->validate($request,[
            'image'=>'required',
            // 'image.*' => '',
            'username'=>'required',
            'email'=>'required',
            'skills'=>'required',
            'experience'=>'required'


        ]);
        
            $image = $request->get('image');
            
            $imagename = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(public_path('images/').$imagename);
     
            $username = $request->get('username');
            $email = $request->get('email');
            $skills = $request->get('skills');
            $experience =$request->get('experience');
            $image = $imagename;
           
         
             DB::table('user_profiles')->insert(['username'=>$username,'email'=>$email,'skills'=>$skills,'experience'=>$experience,'image'=>$image]);
           


    }
}