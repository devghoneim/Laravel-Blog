
@extends('layout.app')


@section('search')
<form class="d-flex" method="get" action="{{ route('posts.search') }}" role="search">
  <input class="form-control me-2" name="q" 
  type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">Search</button>
</form>
@endsection

@section('content')
  @if (session()->has('faild'))
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire({
        title: "Faild!",
        text: "{{ session('faild') }}",
        icon: "error"
    });
</script>
  @endif

    <div class="container mt-5">
      @foreach ( $posts as $post )
        <div class="row my-3">
            <div class="col m-auto">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <h4>{{ $post->user->name}} </h4>
                <h5> Created at {{ $post->created_at->format('y-m-d') }}</h5>
              </div>
              <div class="card-img text-center ">
                <img src="{{ $post->image() }}" width="400px" height="400px">
              </div>
  <div class="card-body">
    <h5 class="card-title">{{ $post->title }}</h5>
    <p class="card-text">{{ \Illuminate\Support\Str::limit($post->description,50) }}</p>
    <a href="{{ route("posts.show",$post->id) }}" class="btn btn-primary">Show</a>
  </div>
</div>
            </div>
        </div>
        @endforeach 
        <div>
          {{ $posts->links() }}
      </div>
    </div>

    @endsection
