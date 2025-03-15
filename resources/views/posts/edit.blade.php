@extends('layout.app')

@section('title') Edit @endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger p-1">
    <ul>
        @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

    <div class="col-8 mx-auto ">
    <form enctype="multipart/form-data" method="POST" action="{{route('posts.update',$post->id)}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" class="form-control"  rows="3">{{$post['description']}}</textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                @foreach ($users as $user )
                <option @selected($user->id == $post->userID) value="{{ $user->id }}">{{ $user->name }}</option>
                
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">Tags</label>
            <select multiple name="tags[]" class="form-control">
                @foreach ($tags as $tag )
                <option @if ($post->tags->contains($tag))
                    selected
                @endif value="{{ $tag->id }}">{{ $tag->name }}</option>
                
                @endforeach
            </select>
            </div>
            <div class="mb-3">
                <label  class="form-label">Add Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                
                <button class="btn btn-success form-control">Submit</button>
                
            </div>
    </form>

    </div>

@endsection