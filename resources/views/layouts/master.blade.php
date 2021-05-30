<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  @yield('extra-meta')

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  @yield('extra-script')

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Core Style CSS -->
  <link rel="stylesheet" href="{{ asset('css/core-style.css') }}">

  <!-- Favicon  -->
  <link rel="icon" href="{{ asset('storage/img/core-img/favicon.ico') }}">
</head>
<body>
  <!-- Search Wrapper Area Start -->
  <div class="search-wrapper section-padding-100">
    <div class="search-close">
      <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="search-content">
            <form action="{{ route('product.search') }}">
              <input type="search" name="q" id="search" value="{{ request()->q ?? '' }}" placeholder="Type your keyword...">
              <button type="submit"><img src="{{ asset('storage/img/core-img/search.png') }}" alt=""></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Search Wrapper Area End -->

  <!-- Events messages Area Start -->
  <!-- On success -->
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  <!-- On error -->
  @if (session('danger'))
    <div class="alert alert-danger">
      {{ session('danger') }}
    </div>
  @endif

  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
  <!-- Events messages Area End -->


  <!-- ##### Main Content Wrapper Start ##### -->
  <div class="main-content-wrapper d-flex clearfix">

    <!-- Mobile Nav (max width 767px)-->
    <div class="mobile-nav">
      <!-- Navbar Brand -->
      <div class="amado-navbar-brand">
        <a href="{{ route('shop.index') }}"><img src="{{ asset('storage/img/logo/logo.png') }}" alt=""></a>
      </div>
      <!-- Navbar Toggler -->
      <div class="amado-navbar-toggler">
        <span></span><span></span><span></span>
      </div>
    </div>

    <!-- Header Area Start -->
    <header class="header-area clearfix">
      <!-- Close Icon -->
      <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
      </div>
      <!-- Logo -->
      <div class="logo">
        <a href="{{ route('shop.index') }}"><img src="{{ asset('storage/img/logo/logo.png') }}" alt=""></a>
      </div>


      <!-- Amado Nav -->
      <!-- Left Navbar -->
      <nav class="amado-nav">
        <ul class="">
          <!-- Authentication Links -->
          @guest
            <li class="">
              <a class="" href="{{ route('login') }}"><strong>{{ __('Login') }}</strong></a>
            </li>
            @if (Route::has('register'))
              <li class="">
                <a class="" href="{{ route('register') }}"><strong>{{ __('Register') }}</strong></a>
              </li>
            @endif
          @else
            <li class="">
              <a id="navbarDropdown" class="" href="{{ route('home') }}">
                <strong>{{ Auth::user()->name }}</strong>
              </a>
            </li>
            <li class="">
              <a class="" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <strong>{{ __('Logout') }}</strong>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        @endguest
      </ul>

      <!-- Amado Nav pages-->
      <ul>
        <li class="active"><a href="{{route('shop.index')}}">Home</a></li>
        <li><a href="{{route('product.index')}}">Shop</a></li>
        {{-- <li><a href="{{ route('product.show', ['slug' => 1])}}">Product</a></li> --}}
        <li><a href="{{route('cart.index')}}">Cart</a></li>
        <li><a href="{{route('checkout.index')}}">Checkout</a></li>
      </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">
      <a href="{{route('product.index')}}" class="btn amado-btn mb-15">%Discount%</a>
      <a href="{{route('product.index')}}" class="btn amado-btn active">New this week</a>
    </div>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
      <a href="{{route('cart.index')}}" class="cart-nav"><img src="{{ asset('storage/img/core-img/cart.png') }}" alt=""> Cart <span>{{ Cart::count() }}</span></a>
      {{-- <a href="#" class="fav-nav"><img src="{{ asset('storage/img/core-img/favorites.png') }}" alt=""> Favourite</a> --}}
      <a href="#" class="search-nav"><img src="{{ asset('storage/img/core-img/search.png') }}" alt=""> Search</a>
    </div>
    <!-- Social Button -->
    <div class="social-info d-flex justify-content-between">
      <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    </div>
  </header>
  <!-- Header Area End -->



  @yield('content')



</div>
<!-- ##### Main Content Wrapper End ##### -->

<!-- ##### Newsletter Area Start ##### -->
<section class="newsletter-area section-padding-100-0">
  <div class="container">
    <div class="row align-items-center">
      <!-- Newsletter Text -->
      <div class="col-12 col-lg-6 col-xl-7">
        <div class="newsletter-text mb-100">
          <h2>Subscribe for a <span>25% Discount</span></h2>
          <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
        </div>
      </div>
      <!-- Newsletter Form -->
      <div class="col-12 col-lg-6 col-xl-5">
        <div class="newsletter-form mb-100">
          <form action="#" method="post">
            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
            <input type="submit" value="Subscribe">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ##### Newsletter Area End ##### -->

<!-- ##### Footer Area Start ##### -->
<footer class="footer_area clearfix">
  <div class="container">
    <div class="row align-items-center">
      <!-- Single Widget Area -->
      <div class="col-12 col-lg-4">
        <div class="single_widget_area">
          <!-- Logo -->
          <div class="footer-logo mr-50">
            <a href="{{route('shop.index')}}"><img src="{{asset('storage/img/logo/logo2.png')}}" alt=""></a>
          </div>
          <!-- Copywrite Text -->
          <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
        <!-- Single Widget Area -->
        <div class="col-12 col-lg-8">
          <div class="single_widget_area">
            <!-- Footer Menu -->
            <div class="footer_menu">
              <nav class="navbar navbar-expand-lg justify-content-end">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="footerNavContent">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="{{route('shop.index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('product.index')}}">Shop</a>
                    </li>
                    <li class="nav-item">
                      {{-- <a class="nav-link" href="{{route('product.show', ['slug' => 1])}}">Product</a> --}}
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('cart.index')}}">Cart</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('checkout.index')}}">Checkout</a>
                    </li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- ##### Footer Area End ##### -->


@yield('extra-js')

{{-- Layout sans Jquery si vue cart.index pour enlever les erreurs de sélecton dans le panier --}}
@includeWhen(Route::currentRouteName() != 'cart.index', 'layouts.jquery')



</body>
</html>
