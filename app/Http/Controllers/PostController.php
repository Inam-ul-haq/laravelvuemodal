<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Post;

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
        dd(1234);

    }


    public function updateProfile(Request $request){
        if($request->photo){

            $name = time().'.'. explode('/',explode(':',substr($request->photo),0,strpos($request->photo,';')))[1])[1]);
        }

    }
}