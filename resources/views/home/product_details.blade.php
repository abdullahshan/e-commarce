<!DOCTYPE html>
<html>


   <head>
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
   </head>
   <body>
      <div class="hero_area">

        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

 <!---product---details---start---->

 <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width:50%; padding:10px;">
    <div class="box">
       <div class="img-box">
          <img style="border-radius: 5px; height:150px" src="{{ asset('storage/product/'.$product->image) }}" alt="">
       </div>
       <div class="detail-box">
          <h5>
             {{ $product->tittle }}
          </h5>
         @if($product->discount_price != null)
          <h6>
             {{ $product->price }}
           </h6>
           <h6 style="text-decoration: line-through; color:red">
              {{ $product->discount_price }}
            </h6>
         @else
          <h6>
             {{ $product->price }}
           </h6>
         

         @endif

         <h6><b>Product Category : </b>{{ $product->categories }}</h6>
         <h6><b>Product description : </b>{{ $product->description }}</h6>
         <h6><b>Product Available : </b>{{ $product->quantity }}</h6>
      
       </div>
    </div>
 </div>
</div>
<!----product---details---end---->
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
     <!-- js end -->
   </body>
</html>