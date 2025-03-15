<?php

namespace App\Http\Controllers\front;

use  App\Models\post;
use App\Http\Controllers\Controller;
use App\Mail\CustomerMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeControlle extends Controller
{
    public function index(){
        $posts = Post::with('user','tags')->orderBy('updated_at','DESC')->paginate(5);
        return  view("front.index",['posts'=>$posts]);
    }

    public function about(){
       
        return  view('front.about');
    }

    
    public function contact(){
       
        return  view('front.contact');
    }


    public function show($id){

        
       $post = Post::findOrFail($id);

        return  view('front.show',compact('post'));
    }

    public function contactMessage(Request $req)
    {

       $data = $req->validate([
            'name'=>['required','string',"min:3","max:30"],
            'email'=>['required','email','max:50'],
            'phone'=>['required','numeric'],
            'message'=>['required','string','min:10','max:500'],

        ]);
        try {
            
            Mail::to("blog@exmple.com")->send(new CustomerMessage($data));
        } catch (\Exception $e) {
        return back()->withErrors('Email Faild');
            
        }
        return back()->with('success','Email Sended Successfully');

    }
}
