<!DOCTYPE html>
<html>
   <head>
    <base href="/public">
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
       <!-- header section strats -->
       @include('home.css')
       <!-- end header section -->
       <style href="text/css">
.row{
    margin: auto;
    align-items: center;
    padding-top: 40px;
    align-content: center;
    text-align: center;
    align-items: center;
    margin: center;
    margin: auto;
    
}

table{

    margin: auto;
    text-align: center;
    align-content: center;
    align-items: center;
}
table th{
    padding: 20px;
    margin: 50px;
    font-size: 20px;

}
table,th,td{

    border: 1px solid gray;
    align-content: center;
    text-align: center;
    align-items: center;
}

.total_price{
    font-size: 20px;
    padding: 10px;
    margin: auto;

}
.total_price h1{
  padding-left: 160px;
  font-size: 20px;
  padding-bottom: 10px;
  font-weight: bold;
}
.img{

   height: 100px;
   
}

.tbody{

    color: red;
   
}
table tbody td {
  height: 50px;
  vertical-align: center;
}

       </style>
   </head>
   <body>
      
      <div class="hero_area">

         <!-- header section strats -->
         <header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{ route('frontend.home') }}"><img width="250" src="images/logo.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="{{ route('frontend.home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                      
                        <li class="nav-item">
                           <a class="nav-link" href="contact.html">Contact</a>
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
         <!-- end header section -->

         @if(session('message'))
         <div class="alert alert-success alert-dismissable" style="width: 500px; margin:auto;text-align:center;">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             {{session('message')}}
         </div>
     @endif

         <div class="row">
            <table class="table table-responsive">
               <tr>
                <thead class="head">
                    <th>product title</th>
                    <th>product quantity</th>
                    <th>price</th>
                    <th>image</th>
                    <th>action</th>
                </thead>
               </tr>
                <tbody class="tbody">

                    <?php $Total_price = 0; ?>
                   @forelse ($cart as $scart)
                       <tr>
                        <td>{{ $scart->tittle }}</td>
                        <td>{{ $scart->quantity }}</td>
                        <td>{{ $scart->price }}</td>
                        <td>
                            <img class="img" src="{{ asset('storage/product/'. $scart->image) }}" alt="">
                        </td>
                        <td>

                           <form method="POST" action="{{ route('remove_cart.home', $scart->id) }}">
                              @csrf
                              <input name="_method" type="hidden" value="DELETE">
                              <button style="background: rgb(238, 41, 41);" type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'>Delete</button>
                          </form>
      
                        </td>
                       </tr>
                       <?php $Total_price = $Total_price + $scart->price ?>
                   @empty
                   
                   @endforelse
                </tbody>
            </table>
         </div>

           <!----Total--price---->     
           <div class="total_price">
            Total Price =  ${{  $Total_price }}
          </div>

          <div class="total_price">
            <h1>Proceed to Order</h1>
            <a href="{{ route('order.home') }}" class="btn btn-danger">Cash On Delivery</a>
            <a href="{{ route('stripe.home', $Total_price) }}" class="btn btn-danger">Pay On Card USD</a>
            <a href="{{ url("/checkout", $Total_price) }}" class="btn btn-danger">Pay On Card BDT</a>
          </div>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
     <!-- js start -->
     @include('home.js')
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
     <!-- js end -->
   </body>
</html>