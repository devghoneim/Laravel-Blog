
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ config('app.name') }}</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('front') }}/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



        <style>
            .active
            {
                font-weight: bold;
                text-shadow: 5px 5px 5px black; 
                
            }
        </style>
    </head>
    <body>

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light sticky-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">{{ config('app.name')}}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-5 py-3 py-lg-4 @if(request()->is('/')) active text-info @endif" href="{{ route('front.index') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-5 py-3 py-lg-4 @if(request()->is('About')) active text-info @endif" href="{{ route('front.about') }}">About</a></li>
                        
                        <li class="nav-item"><a class="nav-link px-lg-5 py-3 py-lg-4 @if(request()->is('Contact')) active text-info @endif" href="{{ route('front.contact') }}">Contact</a></li>

                      
                        @if(Auth::guest())
                        <li class="nav-item">
                            <a class="nav-link px-lg-5 py-3 py-lg-4" href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 text-warning" href="{{ route('posts.index') }}">Dash Post</a></li>
                        <li class="nav-item  mt-3">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline ">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    @endif
                    
                    </ul>
                </div>
            </div>
        </nav>

@yield('content')

            <!-- Footer-->
            <footer class="border-top">
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-md-10 col-lg-8 col-xl-7">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item">
                                    <a href="#!">
                                        <span class="fa-stack fa-lg">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#!">
                                        <span class="fa-stack fa-lg">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#!">
                                        <span class="fa-stack fa-lg">
                                            <i class="fas fa-circle fa-stack-2x"></i>
                                            <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Bootstrap core JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="{{ asset('front') }}/js/scripts.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        </body>
        </html>