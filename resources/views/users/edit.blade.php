@extends('layout.app')

@section('content')
    <div class="col-12">
        <h1 class="my-3 text-center">
             Update User
        </h1>

        <div class="col-6 m-auto">
            <form action="{{ route('users.update',$user->id) }}" class="form border p-3" method="POST">
                @csrf
                @method('PUT')
                @include('inc.message')
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password"  class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Confirm Password</label>
                    <input type="password" name="conPassword"  class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Permission</label>
                    <select name="type" id="" class="form-control">
                        <option @selected($user->type == 'admin') value="admin">Admin</option>
                        <option @selected($user->type == 'writer') value="writer">Writer</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Add" class="bg-success text-white form-control">
                </div>
            </form>
        </div>

    </div>
@endsection