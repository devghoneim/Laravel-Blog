@extends('layouts.app')
@section('title')
Show
@endsection
@section('content')


<div class="card mt-4">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ $post->description }}</p>
        
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        Post creator Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Name:  {{ $post->user->name }}</h5>
        <p class="card-text">Email:  {{ $post->user->email }}</p>
        <p class="card-text">Created At:  {{ $post->created_at->format('y-m-d') }}</p>
    </div>
</div>


@endsection
