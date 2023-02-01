
 <!-- plugins:css -->



 @include('admin.css')

@extends('admin.app')

@section('body')

<style>

  #hellow{
    position: absolute;
    text-align: center;
    align-items: center;
    align-content: center;
    overflow: hidden;
    display: flex;
    position: relative;

  }
   .main-panel{
        width: 1145px;
        margin-left: -14px;
   }


  .card-header{

    display: flex;
    text-align: center;
    align-items: center;
    align-content: center;
  }
  .allproduct{
    margin-left: 10px;
    background-color: rgb(17, 187, 218);
    padding: 10px;
    border-radius: 5px;
  }
  .card-header a{
    text-decoration: none;
  }
    .cardheader{
        font-size: 30px;
        font-weight: bold;
    }
    .btn{
        background-color: rgba(9, 95, 129, 0.938);
    }
    .category{
      margin-left: -23px;
      
    }
    .chooses{
      margin-left: -23px;
      font-weight: bold;
      font-size: 20px;
    }

</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row justify-content-center">

        <div class="card col-lg-10">
            <div class="card-header">
                <h1 class="cardheader">Add product</h1><a class="allproduct" href="{{ route('all_product.home') }}">All Product</a>
            </div>
 
            @if(session('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{session('success')}}
            </div>
        @endif
  
                
            @error('cat_name')
            <div class="alert alert-danger">{{ "Please write your category" }}</div>
            @enderror

            <div class="card-body">
                <form action="{{ route('store_update.home', $product->id) }}" method="post" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="mb-3">
                      <label class="form-label">Tittle</label>
                      <input type="text" name="title" value="{{ $product->tittle }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" value="{{ $product->description }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" value="{{ $product->price }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Discount price</label>
                        <input type="text" name="discount_price" value="{{ $product->discount_price }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Queantity</label>
                        <input type="text" name="queantity" value="{{ $product->quantity }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <img style="width: 150px;" src="{{ asset('storage/product/'. $product->image) }}" alt="">
                      </div>
                    <div class="mb-3 form-check">
                      <label class="chooses">Choose a category:</label><br/>
                        <select name="category" class="category">
                          @foreach ($category as $sdata)
                         
                            <option selected value="{{ $sdata->category_name }}">{{ $sdata->category_name }}</option>
                          @endforeach
                        </select>
                    </div>
                  
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                  </form>
            </div>
        </div>
        </div>
       </div>
    </div>
@endsection


