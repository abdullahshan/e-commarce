<section class="product_section layout_padding" id="to_product">
    <div class="container">
      
      @yield('product_head')


       <!---for search ------------>

       @yield('search_box')


       <!----end Search------------->

       @if(session('message'))
       <div class="alert alert-success alert-dismissable" style="width: 500px; margin:auto;text-align:center;">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">x</span>
           </button>
           {{session('message')}}
       </div>
   @endif
       <div class="row">
       @forelse ($product as $sproduct)
      
         <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="{{ route('product.details', $sproduct->id) }}" class="option1">
                    Product_details
                     </a>
                        <form action="{{ route('add_to_card.home', $sproduct->id) }}" method="POST">
                           @csrf
                           <div class="row">
                           <div class="col md-4">
                              <input type="number" name="quantity" value="1" min="1" style="width: 100%;margin:6px; border-radius: 10px;">
                           </div>
                          <div class="col md-4">
                           <input type="submit" value="Add to card" style="border-radius: 15px;">
                          </div>
                        </div>
                         </form>

                  </div>
               </div>
               <div class="img-box">
                  <img style="border-radius: 5px; height:600px;" src="{{ asset('storage/product/'.$sproduct->image) }}" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                     {{ $sproduct->tittle }}
                  </h5>
                 @if($sproduct->discount_price != null)
                  <h6 style="text-decoration: line-through; color:red">
                    price <br> {{ $sproduct->price }}
                   </h6>
                   <h6>
                    price <br>  {{ $sproduct->discount_price }}
                    </h6>
                 @else
                  <h6>
                    price <br> {{ $sproduct->price }}
                   </h6>
                 

                 @endif

              
               </div>
            </div>
         </div>
       
       @empty
      </div>
       @endforelse

       {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
      </div>
 </section>