@extends('layout.app')

@section('title') Create @endsection

@section('content')


    <div class="col-8 mx-auto ">
    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
        @csrf
        @include('inc.message')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="{{old('title')}}">
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" class="form-control"  rows="3">{{old('description')}}</textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                @foreach ($users as $user )
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">Tags</label>
            <select multiple name="tags[]" class="form-control">
                @foreach ($tags as $tag )
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                
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