


@extends('layout.app')
@section('title')
index
@endsection
@section('content')



<div>
    <div class="text-center my-3">
        <a href="{{route('users.create')}}" class="btn btn-success">Add New user</a>
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
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Type</th>
      <th scope="col">Actions</th>  
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user )
      
    <tr>
      <th scope="row">{{(($users->currentPage() - 1) * $users->perPage()) + $loop->iteration}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{!! $user->type()!!}</td>
      <td>
      
      <a href="{{route('users.posts',$user['id'])}}" class="btn btn-info">All Posts</a>
      <a href="{{route('users.edit',$user['id'])}}" class="btn btn-primary">Edit</a>
      
      <form action="{{route('users.destroy',$user->id)}}" method="post" class="d-inline"  onsubmit="return confirmDelete()">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="Delete">
      </form>
      <script>
        function confirmDelete() {
            return confirm("Do you want to delete this User?");
        }
        </script>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

<div>
  {{ $users->links() }}
</div>
</div>

@endsection