<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\post;

class PostController extends Controller
{
    public function home(){
        $posts = Post::paginate(5);
        return  view("home",['posts'=>$posts]);
    }
    public function index(){
        $posts = Post::paginate(15);
        return  view("posts.index",['posts'=>$posts]);
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



        return view('posts.create');
    }
    public function edit($id){

        $post = post::findOrFail($id);


        return view('posts.edit',['post'=>$post]);
    }

    public function store(Request $req){

        $req->validate([
            'title'=>['required' , 'string' , 'min:3'],
            'description'=>['required' , 'string' , 'max:1000'],
            'post_creator'=>['required' , 'integer' , 'exists:users,id']
        ]);

        $post = new post();
        $post->title = $req->title;
        $post->description = $req->description;
        $post->userID = $req->post_creator;
        $post->save();

        return back()->with('success','Post Added Successfuly');


       
    }
    public function update($id , Request $req) {
        $post = Post::findOrfail($id);
        $req->validate([
            'title'=>['required' , 'string' , 'min:3'],
            'description'=>['required' , 'string' , 'max:1000'],
            'post_creator'=>['required' , 'integer' , 'exists:users,id']
        ]);
        
        $post->title = $req->title;
        $post->description = $req->description;
        $post->userID = $req->post_creator;
        $post->save();
        
       return redirect()->route('posts.index')->with('success','Updated Successfully');
         
     }

    public function destroy($id) {

       $post = Post::findOrfail($id);
        $post->delete();
        return back()->with('success','Deleted Successfuly');
       
       
       
      
        
    }
}
