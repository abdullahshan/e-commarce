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
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <!-- end header section -->
     
   </head>
   <body>
      <div class="hero_area">

         @include('vendor.sweetalert.alert')

         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->

         <!-- slider section -->
         @include('home.slide');
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home.why');
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.arrival')
      <!-- end arrival section -->

      

      
      
   <!-- product section -->
   @section('product_head')
   <div style="margin: auto; text-align:center; color:black;weght:bold; padding-bottom:20px;">
      <h2 style="font-size: 60px;">
         <b>Our <span style="color: rgb(233, 42, 42)">Products</span></b>
      </h2>
   </div>
   @endsection

   <!--search box------>
   @section('search_box')
   <div style="margin: auto; width:300px;">
      <form action="{{ route('search_product.home') }}" method="GET">
         @csrf
      
         <input style="border-radius: 5px;" type="text" name="search" placeholder="Search product">
         <input style="border-radius: 10px;" type="submit" value="search">
      </form>
    </div>
   @endsection
   <!---end search box---->
      @include('home.product')
 
      <!-- end product section -->

      <!---Comment start heare------>
      @if(session('success'))
      <div class="alert alert-success alert-dismissable" style="width: 500px; margin:auto;text-align:center;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">x</span>
          </button>
          {{session('success')}}
      </div>
  @endif



      <div style="margin: auto; text-align:center;">

         <h1 style="font-size: 30px; padding-bottom:10px;">Comment</h1>

         <form action="{{ route('add_comment.home') }}" method="POST">
            @csrf
            <textarea style="height:50px; width:400px;" name="comment" placeholder="Write something heare"></textarea>
            <input style="margin-bottom: 20px;" type="submit" value="sumbit" class="btn btn-primary">
         </form>
      </div>

      <!-----All Comment-------->

      <div style="padding-bottom: 5px; margin-left:20%">

         <h1 style="font-size: 20px; padding-bottom:10px;">All Comment</h1>

         @foreach ($comment as $scomment)

         <div>
            <b>{{ $scomment->name }}</b>
            <p>{{ $scomment->comment }} </p>
            <a href="javascript::void(0);" data_commentId="{{ $scomment->id }}" onclick="reply(this)">Reply</a>
         </div>

               <div style="padding-left: 3%">
               
               @foreach ($reply as $sreply)
              @if ($sreply->comment_id==$scomment->id)
                 <b>{{ $sreply->name }}</b>
                 <p>{{ $sreply->reply }}</p>
                 <a href="javascript::void(0);" data_commentId="{{ $scomment->id }}" onclick="reply(this)">Reply</a>
               <br>
                 @endif
               
                  @endforeach 
               </div>
               
         @endforeach
         {!!$comment->withQueryString()->links('pagination::bootstrap-5')!!}
<!---Reply box heare---------->

            <div style="display: none;" id="replayDiv">

               <form action="{{ route('add_reply.home') }}" method="POST">
                  @csrf

               <input type="text" name="comment_id" id="comment_id" hidden="">
               <textarea style="height:50px; width:400px;" name="reply" placeholder="Write something heare"></textarea>
               <br/>
               <button class="btn btn-primary">submit</button>
              <a style="color: darkorange;" href="javascript::void(0);" onclick="reply_close(this)">close</a>
             
            </form>
               </div>
        
       
      </div>

     
      <!-----All coment end----->
      <!---Comment end heare-------->


      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->

      <!-- client section -->
      @include('home.cliend')
      <!-- end client section -->

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
     <!-- js start -->
     <script type="text/javascript">
      
     function reply(caller)
     {

      document.getElementById('comment_id').value=$(caller).attr('data_commentId');

      $("#replayDiv").insertAfter($(caller));
      $("#replayDiv").show();
     }

     function reply_close(caller)
     {
      $("#replayDiv").hide();
     }

   </script>

   <!---It will do magic------->

   <script>
      document.addEventListener("DOMContentLoaded", function(event) { 
          var scrollpos = localStorage.getItem('scrollpos');
          if (scrollpos) window.scrollTo(0, scrollpos);
      });

      window.onbeforeunload = function(e) {
          localStorage.setItem('scrollpos', window.scrollY);
      };
  </script>
  

      <!---end---->
    <!-- jQery -->
   @include('home.js')
     <!-- js end -->

     
     <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };
    
            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
   </body>
</html>