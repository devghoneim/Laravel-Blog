


@extends('layout.app')
@section('title')
index
@endsection
@section('content')

@can('create',\App\Models\Tag::class)
  

<div>
  <div class="text-center my-3">
    <a href="{{route('tags.create')}}" class="btn btn-success">Add New Tag</a>
  </div>
</div>
@endcan

<div class="container">
  {{-- @if (session()->has('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      Swal.fire({
          title: "Success!",
          text: "{{ session('success') }}",
          icon: "success"
      });
  </script>
  @endif --}}

  <div class="alert d-none" id="show-message"></div>
<table class="table text-center">
  <thead>
    <tr class="">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Actions</th>  
    </tr>
  </thead>
  <tbody>
    @foreach ($tags as $tag )
      
    <tr>
      <th scope="row">{{(($tags->currentPage() - 1) * $tags->perPage()) + $loop->iteration}}</th>
      <td>{{$tag->name}}</td>

      <td>
      <a href="{{route('tags.posts',$tag['id'])}}" class="btn btn-info">All Posts</a>
      <a href="{{route('tags.edit',$tag['id'])}}" class="btn btn-primary">Edit</a>
      <form action="{{route('tags.destroy',$tag['id'])}}" method="post" class="d-inline data" id="send-data"  onsubmit="return confirmDelete()">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="Delete">
      </form>
      <script>
        function confirmDelete() {
            return confirm("Do you want to delete this tag?");
        }
        </script>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

<div>
  {{ $tags->links() }}
</div>
</div>

@endsection

@section('script')

<script>

let formElement = document.querySelectorAll('.data')
let messageElement = document.getElementById('show-message')

formElement.forEach(e => {
  e.addEventListener('submit',function(x){
    x.preventDefault()
    
  token = document.querySelector('input[name=_token]').value
  fetch(e.action,{
    method:"DELETE"  ,
    headers:{
      'X-CSRF-TOKEN':token,
      'Accept':'application/json',
      'Content-Type':'application/json'
    }
  }).then(res=>{
    return res.json();
  }).then(data=>{

    messageElement.classList.remove('d-none');
  if (data['status']) {
    messageElement.classList.add('alert-success');
    e.closest('tr').remove();

  } else
  {
    
    messageElement.classList.add('alert-danger');
  }   

  messageElement.textContent=data.message

  })
  })
});


</script>

@endsection