@extends('admin.app')

@section('body')

<style>
    .main-panel{
        width: 1145px;
        margin-left: -14px;
   }

    .allcate{
      font-size: 40px;
      font-weight: bold;
    }
    .allcate{
        text-align: center;
    }
    
    .addcate{
        
        background-color: rgb(7, 216, 199);
        margin: 10px;
        border-radius: 5px;
        padding: 10px;
      
    }
     .card-header a{
      text-decoration: none;
    }
    .card-header{
        display: flex;
        align-items: center;
        align-content: center;
    }
   .table thead{
    background-color: black;
   }
   .table thead th{
    font-size: 20px;
   }
</style>
<div class="main-panel">
    <div class="content-wrapper">
       <div class="row justify-content-center">
        <div class="card">
          <div class="card-header">
           <h1 class="allcate">All Product</h1><a class="addcate" href="{{ route('view_product.home') }}">Add Product</a>
          </div>
             <div class="card-body">

              @if(session('success'))
              <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">x</span>
                  </button>
                  {{session('success')}}
              </div>
          @endif
                <table class="table table-responsive">
                    <thead class="head">
                      <tr>
                        <th>id</th>
                        <th>tittle</th>
                        <th>description</th>
                        <th>image</th>
                        <th>price</th>
                        <th>discount_price</th>
                        <th>quantity</th>
                        <th>categories</th>
                        <th>created_at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($data as $sdata)
                       <tr>
                        <td>{{ $sdata->id }}</td>
                        <td>{{ $sdata->tittle }}</td>
                        <td>{{ $sdata->description }}</td>
                        <td>
                            <img style="object-fit: cover;width: 100px;height: 100px;"src="{{ asset('storage/product/'. $sdata->image) }}" alt="">
                        </td>
                        <td>{{ $sdata->price }}</td>
                        <td>{{ $sdata->discount_price }}</td>
                        <td>{{ $sdata->quantity }}</td>
                        <td>{{ $sdata->categories }}</td>
                        <td>{{ $sdata->created_at->diffForHumans() }}</td>
                        <td>
                            <form style="display: inline;" action="{{ route('delete_product.home', $sdata->id) }}" method="POST">
                               @method('post')
                               @csrf
                             <button class="btn btn-danger">delete</button>
                            </form>
                            <a href="{{ route('update_product.home', $sdata->id) }}" class="btn btn-primary">edite</a>
                        </td>
                      
                       </tr>
                    @empty
                        <div class="alert alert-danger">
                            <h1>Product data not fonund!</h1>
                        </div>
                    @endforelse
                    </tbody>
                  </table>
             </div>
           </div>
       </div>
    </div>
</div>
@endsection


