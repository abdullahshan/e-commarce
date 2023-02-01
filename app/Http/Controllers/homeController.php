<?php

namespace App\Http\Controllers;


use PDO;
use Stripe;
use Session;
use Stripe\Charge;
use App\Models\cart;
use App\Models\User;
use App\Models\order;
use App\Models\reply;
use App\Models\comment;
use App\Models\order_detail;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpKernel\HttpCache\Esi;

class homeController extends Controller
{

 //-------frontend-Route-----------//

    public function index(){

        $product = product::paginate(3);
        $comment = comment::orderby('id','desc')->paginate(3);
        $reply = reply::all();

        return view('home.userpage', compact('product','comment','reply'));
    }

 //-------backend-Route-----------//   
    public function backend(){


        $usertype = Auth::user()->usertype;

        if($usertype == '1'){

            $product = product::get()->count();
            $order = order::all()->count();
            $user = Auth::user()->all()->count();

            // $total_price = 0;
            // foreach($revenue as $srevenue){
            // $total_price = $total_price + $srevenue->price;
            // }

            

            // //dd($total_price);

            // $delivery_product = order::where('delivery_status','=','delivered')->get()->count();
            // $procced_delivery = order::where('delivery_status','=','procced delivery')->get()->count();


            // $Total_delivery_price = order::where('delivery_status','=','delivered')->get();
            
        //     $total_deliveri_price = 0;
        //    foreach($Total_delivery_price as $sprice){

        //         $total_deliveri_price = $total_deliveri_price + $sprice->price;
        //    }
            

            return view('admin.home', compact('product','user','order'));
        }else{

        $product = product::paginate(3);

            $comment = comment::orderby('id','desc')->paginate(3);
            $reply = reply::all();

            return view('home.userpage', compact('product','comment','reply'));
        }
    }

    
//-----product---part---------//
public function product_details($id){

    $product = product::find($id);
    
     return view('home.product_details', compact('product'));
    }
///////add cart //////

    public function add_to_card(Request $request, $id){
    
        if(Auth::id()){
    
            $user = Auth::user();
            $user_id = $user->id;
            $product = product::find($id);


            $cart_exit_id = cart::where('product_id','=',$id)->where('user_id','=',$user_id)->get('id')->first();

            if($cart_exit_id){

                $cart = cart::find($cart_exit_id)->first();

                    $quantity = $cart->quantity + $request->quantity;
                    $cart->quantity = $quantity;

                    if($product->discount_price != null){
        
                        $cart->price = $product->discount_price * $cart->quantity;
                    }else{
                        $cart->price = $product->price * $cart->quantity;
                    }
                $cart->save();

                Alert::success('Product Added Successfully Done!','We Have Added Product IN The Cart');

                return redirect()->back();

            }else{

                $cart = new cart();

                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->tittle = $product->tittle;
                $cart->description	 = $product->description;
        
                if($product->discount_price != null){
        
                    $cart->price = $product->discount_price * $request->quantity;
                }else{
                    $cart->price = $product->price * $request->quantity;
                }
        
                $cart->quantity = $request->quantity;
                $cart->user_id = $user->id;
                $cart->product_id = $product->id;
                $cart->image = $product->image;
                $cart->save();

                Alert::success('Product Added Successfully Done!','We Have Added Product IN The Cart');
        
                return redirect()->back()->with('message','Please check in the card And confirm your order');


            }
            
           
            
        }else{
            return redirect('login');
        }
    }

//////////////////
public function show_cart(){
    
    if(Auth::id()){

        
    $user_id = Auth::user()->id;

    $cart = cart::where('user_id','=', $user_id)->get();
 
    return view('home.show_cart', compact('cart'));
    }else{

        return redirect('login');
    }

   
}

//////////////
public function remove_cart($id){

   $cart = cart::find($id);

   $cart->delete();

   return redirect()->back();

}

//////////////
public function order(){

$data = cart::get();

$user = Auth::user()->id;

$user_data = User:: where('id','=',$user)->first();


$cart = cart:: where('user_id','=', $user)->get();


$total_price = 0;
foreach($cart as $cart_price){

    $total_price = $total_price + $cart_price->price;
}


if($cart != null){

  
    $data = new order();
 
    $data->name = $user_data->name;
    $data->email = $user_data->email;
    $data->phone = $user_data->phone;
    $data->amount = $total_price;
    $data->address = $user_data->address;

    $data->status = "pending";
    $data->currency = "BDT";

    $data->save();

    $order_id = $data->id;


foreach($cart as $cart){


    $data = new order_detail();
    
    $data->product_id = $cart->id;
    $data->order_id = $order_id;
    $data->product_name = $cart->name;
    $data->product_quantity = $cart->quantity;
    $data->product_price = $cart->price;

    $data->save();

    $cart_id = $cart->id;
    $delete_data = cart::find($cart_id);

    $delete_data->delete();

}

    return redirect()->back()->with('message','Thank You, Your Order Is Redy Soon!');
 
}else{

return redirect()->back()->with('message','Please Add Product To Cart');
}

}

/////////////
public function stripe($Total_price){

    $price = $Total_price;
    if( $price == 0){
        return redirect()->back()->with('message','Please Add Product To Cart');
    }else{
        return view('home.stripe', compact('price'));
    }

}
///////
/**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, $price)
    {

      
            $address_2 = $_POST['address_2'];
            $country = $_POST['country'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
       

        $data = cart::get();

        $c = count($data);

        if($c==true){


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thank you! pay for payment from creative.com." 
        ]);

        $user_email = Auth::user()->email;
        $user_data = User:: where('email','=', $user_email)->first();

         $data = new order();
     
         $data->name = $user_data->name;
         $data->email = $user_data->email;
         $data->phone = $user_data->phone;
         $data->amount = $price;
         $data->address = $user_data->address;
     
         $data->address_2 = $address_2;
         $data->country = $country;
         $data->state = $state;
         $data->zip = $zip;
         $data->status = "completed";
         $data->currency = "USD";
     
         $data->save();
        $order_id = $data->id;
         

    $cart = cart:: where("email","=",$user_email)->get();
    foreach($cart as $cart){

    $data = new order_detail();
    
    $data->product_id = $cart->id;
    $data->order_id = $order_id;
    $data->product_name = $cart->name;
    $data->product_quantity = $cart->quantity;
    $data->product_price = $cart->price;

    $data->save();

    $cart_id = $cart->id;
    $delete_data = cart::find($cart_id);

    $delete_data->delete();

}
        
        return back()->with('success','payment succesfully done!');

    }else{

        return redirect()->back()->with('success','Sorry you have not any orders!');
        }
    }

    //////---show---orders---//
    public function show_orders(){

      
        if(Auth::id()){

            $user = Auth::user();

            $user_id = $user->id;
    
            // $order = order::where('user_id','=',$user_id)->orderby('id','desc')->paginate(5);
    
            return view('home.show_orders');
        }else{

            return redirect('login');
        }
        
  
    }

    ///--cancle--order--///
    public function cancle_order($id){

      $cancle_order = order::find($id);

    if($cancle_order->delivery_status == 'procced delivery'){
        $cancle_order->delivery_status = 'canceled';
        $cancle_order->save();
    }

        return back()->with('message','Your Order Canceled!');

    }

    ///----Add Comment heare-------//
    public function add_comment(Request $request){

            if(Auth::id()){

                $comment = new comment();

                $comment->name = Auth::user()->name;
                $comment->user_id = Auth::user()->id;
                $comment->comment = $request->comment;
                $comment->save();

                return redirect()->back()->with('success','You send a Comment');
            }else{
                return redirect('login');
            }
    }

///----For reply--------///
public function add_reply(Request $request){

    if(Auth::id()){
        
    $reply = new reply();

    $comment = comment::all();

        $reply->name = Auth::user()->name;
        $reply->comment_id = $request->comment_id;
        $reply->reply = $request->reply;
        $reply->user_id = Auth::user()->id;
        $reply->save();

        return redirect()->back();
    }else{
        return redirect('login');
    }
}

//////---Search for porduct----///
public function search_product(Request $request){

     $comment = comment::orderby('id','desc')->paginate(3);
    $reply = reply::all();
    
    $search = $request->search;

    
    $product = product::where('tittle','LIKE',"%$search%")->paginate(10);

    

   return view('home.userpage',compact('product','comment','reply'));

}

///for product_page////

/////---Search for porduct----///
public function search_product_page(Request $request){

    $comment = comment::orderby('id','desc')->paginate(3);
   $reply = reply::all();
   
   $search = $request->search;

   
   $product = product::where('tittle','LIKE',"%$search%")->paginate(10);

   

  return view('home.product_page', compact('product','comment','reply'));

}

///Product page ////
public function product_page(){

    $product = product::orderby('id','desc')->paginate(3);
    $comment = comment::orderby('id','desc')->paginate(3);
    $reply = reply::all();
    return view('home.product_page', compact('product','comment','reply'));
}

}