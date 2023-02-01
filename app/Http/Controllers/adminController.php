<?php

namespace App\Http\Controllers;

use PDF;
use Notification;
use App\Models\cart;
use App\Models\order;
use App\Models\reply;
use App\Models\comment;
use App\Models\product;
use App\Models\category;
use App\Models\order_detail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use App\Notifications\send_emailnotification;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class adminController extends Controller
{


    public function text(){

        // $role = Role::create(['name' => 'admin']);
        $role = Role::find(1);
     
        $user = User::find(1);
       
        $user->assignRole($role);

        

    }

//-----Categories----Part---------------//

    public function category(){

        if(Auth::id()){

            
        $usertype = Auth::user()->usertype;

        if($usertype == '1'){

            return view('admin.category');

             }else{

                return redirect('http://127.0.0.1:8000/');

             }


        }else{
            return redirect('login');
        }
    }


////////////////////
    public function addcategory(Request $request){
        
            $data = new category();

            $request->validate([
                'cat_name' => 'required',
                
            ]);

            $data->category_name = $request->cat_name;
            $data->save();

            return redirect()->back()->with('success','Category insert is Successfully done!');
    }

//////////////////////
    public function allcategory(){

        $data = category::get()->all();

        return view('admin.allcategory', compact('data'));
    }
////////////////////////
    public function delete($id){

        $data = category::find($id);
        $data->delete();

        return back()->with('success','Data delete successfully done!');

    }
//------------end------------------//





//----------Product--Part-------//

public function view_product(){
    
    $data = category::get()->all();
    return view('admin.view_product', compact('data'));
}

/////////////////////
public function store_product(Request $request){


    $file = $request->file('image');
     
    if($file){

        $fileName = 'product' . uniqid(). '.'. $file->getClientOriginalExtension();

        $file->move('storage/product',$fileName);

    }
    $data = new product();
   
    $data->tittle = $request->title;
    $data->description = $request->description;	
    $data->image = $fileName;
    $data->price = $request->price;
    $data->quantity = $request->queantity;
    $data->categories = $request->category;
    $data->discount_price = $request->discount_price;
    $data->save();

    return back()->with('success','Product store successfully done!');
}


////////////////////
public function all_product(){

    $data = product::get()->all();

    return view('admin.allproduct', compact('data'));
}


//////////////////////
public function delete_product($id){

    $product_delete = product::find($id);
    $product_delete->delete();

    return back()->with('success','Product delete successfully done!');
}

/////////////////////
public function update_product($id){

    
    $product = product::find($id);
    

    $category = category::get()->all();

   
    return view('admin.update_product', compact('product','category'));

}
///////////////////////
public function store_update(Request $request, $id){

    $store_update = product::find($id);

    $image = $request->image;
    
    if($image){

        $imageName = "update_". uniqid(). "." . $image->getClientOriginalExtension();


        if(Storage::disk('public')->exists('product/',$store_update->image)){
            unlink(public_path('storage/product/') . $store_update->image);
           }

        $image->move('storage/product', $imageName);
        $store_update->image = $imageName;
    }
    
    $store_update->tittle = $request->title;
    $store_update->description = $request->description;	
    $store_update->price = $request->price;
    $store_update->quantity = $request->queantity;
    $store_update->categories = $request->category;
    $store_update->discount_price = $request->discount_price;
    $store_update->save();

    return redirect(route('all_product.home'))->with('success','Product update successfully done!');
}

/////////---all---orders----///
public function orders_product(){

    $data = order::get();
    return view('admin.order', compact('data'));
}
///-----Delivered----//////
public function delivered($id){

    $data = order::find($id);

    return back();
}
///////---download---pdf---///
public function pdf_download($id){

    $data = order::find($id);
 
    $pdf=PDF::loadView('admin.pdf', compact('data'));
     
    return $pdf->download('Orders_deltais.pdf');
   
}
/////---send_email---////
public function send_email($id){

    $user = order::find($id);
   
  return view('admin.send_email', compact('user'));
}
///--send_user_email--///
public function send_user_email(Request $request, $id){

    $user = order::find($id);

    $details = [

        'greeting' => $request->greeting,
        'first_name' => $request->first_name,
        'body' => $request->body,
        'button' => $request->button,
        'url' => $request->url,
        'last_name' => $request->last_name

    ];

    Notification::send($user, new send_emailnotification($details));

    return redirect()->back()->with('success','Email Send Successfully Done!');
}

/////////-----Search---////////
public function search(Request $request){

    $search = $request->search;

    $data = order::where('name','LIKE',"%$search%")->orwhere('id','LIKE',"%$search%")->get();

    return view('admin.order', compact('data'));
}

///order_details//

    public function order_details($id){

       
        $details = order_detail:: where("order_id","=",$id)->get();
       
        return view('admin.order_details',compact('details'));
    }

}