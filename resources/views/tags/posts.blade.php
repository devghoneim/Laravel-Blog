


@extends('layout.app')
@section('title')
index
@endsection
@section('content')



<div>
    <div class="text-center my-3">
        <a href="{{url('posts/create')}}" class="btn btn-success">New Post</a>
        <h1 class="p-3 border text-center my-3"> All Posts For {{ $user->name }} </h1>
    </div>
</div>

<div class="container">
  @if (session()->has('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      Swal.fire({
          title: "Success!",
          text: "{{ session('success') }}",
          icon: "success"
      });
  </script>
  @endif
<table class="table text-center">
  <thead>
    <tr class="">
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Posted By</th>
      <th scope="col">Created at</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($user->posts as $post )
      
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{\Illuminate\support\str::limit($post['title'],10)}}</td>
      <td>{{\Illuminate\support\str::limit($post['description'],10)}}</td>
      <td>{{$post->user->name}}</td>
      <td>{{$post['created_at']}}</td>
      <td>
      
      <a href="{{route('posts.show',$post['id'])}}" class="btn btn-info">View</a>
      <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>
      
      <form action="{{route('posts.destroy',$post['id'])}}" method="post" class="d-inline"  onsubmit="return confirmDelete()">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="Delete">
      </form>
      <script>
        function confirmDelete() {
            return confirm("Do you want to delete this post?");
        }
        </script>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

{{-- <div>
  {{ $posts->links() }}
</div> --}}
</div>

@endsection