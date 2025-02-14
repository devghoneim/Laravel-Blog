@extends('layouts.app')

@section('title') Create @endsection

@section('content')


    <div class="col-8 mx-auto ">
    <form method="POST" action="{{route('posts.store')}}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger p-1">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
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
              <option value="1">Ahmed</option>
              <option value="2">Mohamed</option>
            </select>
        </div>

        <button class="btn btn-success form-control">Submit</button>
    </form>

    </div>

@endsection