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
        <div class="card col-lg-10">
          <div class="card-header">
           <h1 class="allcate">All Orders</h1>
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

          <form action="{{ route('search.home') }}" method="get">
            @csrf
            <div style="padding-bottom: 10px;font-size:20px;">
              <label for="">Search : </label>
              <input type="text" name="search" placeholder="search">
              <button style="background: rgb(33, 33, 218)" type="submit" class="btn btn-primary">suarch</button>
            </div>
           </form>
                <table class="table table-responsive">
                    <thead class="head">
                      <tr>
                        <th>id</th>
                        <th>order_id</th>
                        <th>product_id</th>
                        <th>product_name</th>
                        <th>product_quantity</th>
                        <th>product_price</th>
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($details as $key=> $data)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $data->order_id }}</td>
                            <td>{{ $data->product_id }}</td>
                            <td>{{ $data->product_name }}</td>
                            <td>{{ $data->product_quantity }}</td>
                            <td>{{ $data->product_price }}</td>
                        </tr>
                    @empty
                       
                    <tr>
                      <td colspan="16">
                        <h1 style="font-size: 40px;color:red;">Data Not Found!</h1>
                      </td>
                    </tr>
                      
                    @endforelse

                    </tbody>
                  </table>
             </div>
           </div>
       </div>
    </div>
</div>
@endsection


