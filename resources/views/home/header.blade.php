<header class="header_section">
    <div class="container">
       <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{ route('frontend.home') }}"><img width="250" src="{{ asset('images/logo.png') }}" alt="#" /></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav">
                <li class="nav-item active">
                   <a class="nav-link" href="{{ route('frontend.home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
               <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                   <ul class="dropdown-menu">
                      <li><a href="#to_product">About</a></li>
                      <li><a href="#to_product">Testimonial</a></li>
                   </ul>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="{{ route('product_page.home') }}">Products</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="#why">Blog</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="#to_product">Contact</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="{{ route('show_cart.home') }}">Cart</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('show_orders.home') }}">Orders</a>
               </li>
                
                <form class="form-inline">
                   <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                   <i class="fa fa-search" aria-hidden="true"></i>
                   </button>
                </form>

                @if (Route::has('login'))

                @auth
                <x-app-layout>
  
               </x-app-layout>

                @else
                <li class="nav-item">
                  <a href="{{ route('login') }}" class="btn btn-primary" id="logincss">Login</a>
               </li>
               <li class="nav-item">
                  <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
               </li>

               @endauth
               @endif

             </ul>
          </div>
       </nav>
    </div>
 </header>