<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TagContronller extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('id','DESC')->paginate(10);
       return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $tag = $request->validate([
            'name'=>['required','string','min:3','max:50'],
        ]);

        Tag::create($tag);

        return response()->json(['status'=>'success','message'=>'Tag Added Successfully'] );

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update(['name'=>$request->name]);
        $tag->save();
        return response()->json(['status'=>'success','message'=>'Tag Updated Successfully']);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {

        $tag->delete();        
        
        return response()->json(['status'=>'success','message'=>'Tag Deleted Successfully']);

    }
}
