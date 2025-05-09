<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
">
<style>
  .active
  {
    font-weight: bold;
  }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item @if (request()->is('/')) active  @endif">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>

        @auth
          
        
        <li class="nav-item @if (request()->is('posts*')) active  @endif">
          <a class="nav-link" href="{{url('posts')}}">Posts</a>
        </li>
        @can('admin-controlle')
        <li class="nav-item @if (request()->is('users*')) active  @endif">
          <a class="nav-link" href="{{route('users.index')}}">Users</a>
          
        </li>
        <li class="nav-item @if (request()->is('tags*')) active  @endif">
          <a class="nav-link" href="{{route('tags.index')}}">Tags</a>          
        </li>
        @endcan
        @endauth
      </ul>
    @yield('search')

    <ul class="navbar-nav ms-auto">
      <!-- Authentication Links -->
      @guest
          @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
          @endif

          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
      @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
          </li>
      @endguest
  </ul>
    </div>
  </div>
</nav>



<div class="container mt-5">

@yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
"></script>
@yield('script')
</body>
</html>