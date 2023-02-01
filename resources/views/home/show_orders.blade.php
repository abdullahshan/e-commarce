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
  padding-left: 50px;
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
         @include('home.header')
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
           <table>
            <thead>
                <th>tittle</th>
                <th>quantity</th>
                <th>price</th>
                <th>payment_status</th>
                <th>delivery_status</th>
                <th>image</th>
                <th>cancle</th>
            </thead>
                <tbody>
                 
                   
                </tbody>
               
           </table>
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
     <!-- js end -->
   </body>
</html>