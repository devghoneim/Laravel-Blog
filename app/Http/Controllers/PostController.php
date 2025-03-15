<?php

namespace App\Http\Controllers;

use  App\Models\post;
use App\Models\Tag;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    
    
    // public function home(){
    //     $posts = Post::orderBy('updated_at','DESC')->paginate(5);
    //     return  view("home",['posts'=>$posts]);
    // }
    public function index() {
        $user = Auth::user();
        if ($user->type == 'admin') {
            $posts = Post::with('user', 'tags')
                ->orderBy('updated_at', 'DESC')
                ->paginate(15);
        } else {
            $posts = Post::with('user', 'tags')
                ->where('userID', $user->id)
                ->orderBy('updated_at', 'DESC')
                ->paginate(15);
        }
    
        return view("posts.index", ['posts' => $posts]);
    }
    
    public function show($id){
        $post = post::findOrFail($id);
        return view('posts.show',['post'=>$post]);
    }
    public function search(Request $req){
        $post = Post::where('description','like','%'. $req->q.'%')->get();
        if ($post->isNotEmpty()) {
            
            
            return view('posts.search',['posts'=>$post]);
            exit();
        }
        return back()->with('faild','Not Found');
        
        
        
    }
    public function create(){
        Gate::authorize('create-post');
        $tags = Tag::select('id','name')->get();
        $users = User::select('id','name')->get();
        return view('posts.create' , compact('users','tags'));
    }

    public function edit($id){
        $post = post::findOrFail($id);
        Gate::authorize('edit-post',$post);
        $users=User::select('id','name')->get();
        $tags = Tag::select('id','name')->get();
        return view('posts.edit',compact('post','users','tags'));
    }

    public function store(Request $req){
        Gate::authorize('create-post');
        $req->validate([
            'title'=>['required' , 'string' , 'min:3'],
            'description'=>['required' , 'string' , 'max:1000'],
            'post_creator'=>['required' , 'integer' , 'exists:users,id'],
            'image'=>['required','image','mimes:png,jpg,jpge,gif'],
            'tags'=>['required','exists:tags,id']
        ]);
        $image = $req->file('image')->store('public');
        
        $post = new post();
        $post->title = $req->title;
        $post->description = $req->description;
        $post->userID = $req->post_creator;
        $post->image = $image;
        $post->save();
        $post->tags()->sync($req->tags);
        return back()->with('success','Post Added Successfuly');


       
    }
    public function update($id , Request $req) {
        $post = Post::findOrfail($id);
        $old_image = $post->image;
        $req->validate([
            'title'=>['required' , 'string' , 'min:3'],
            'description'=>['required' , 'string' , 'max:1000'],
            'post_creator'=>['required' , 'integer' , 'exists:users,id'],
            'tags'=>['required','exists:tags,id'],
            'image'=>['required','image','mimes:png,jpg,jpge,gif'],
        ]);
        
        $post->title = $req->title;
        $post->description = $req->description;
        $post->userID = $req->post_creator;
        if ($req->hasFile('image')) {
        $image = $req->file('image')->store('public');
        File::delete($old_image);
        $post->image = $image;
        }
        $post->save();
        
        $post->tags()->detach();
        $post->tags()->sync($req->tags);
       return redirect()->route('posts.index')->with('success','Updated Successfully');
         
     }

    public function destroy($id) {

       $post = Post::findOrfail($id);
        $post->delete();
        return back()->with('success','Deleted Successfuly');
       
       
       
      
        
    }
}
