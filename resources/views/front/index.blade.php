
@extends('front.layouts.app')

@section('content')
    
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('{{ asset('front') }}/assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Clean Blog</h1>
                            <span class="subheading">A Blog Theme by Start Bootstrap</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
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

                <div class=" my-3 text-center ">
                @foreach ($post->tags as $tag)
                <span class="badge bg-success  ">{{ $tag->name }}</span>
                @endforeach
            </div>
                
                <div class="text-center ">

                    <a href="{{ route("front.show",$post->id) }}" class="btn btn-primary w-50 ">Show</a>
                    </div>

              </div>
            </div>
                        </div>
                    </div>
                    @endforeach 
                    <div>
                      {{ $posts->links() }}
                  </div>
                </div>
            </div>
        </div>

@endsection
    