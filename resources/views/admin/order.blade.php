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
                        <th>sl.no</th>
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>amount</th>
                        <th>address</th>
                        <th>address_2</th>
                        <th>country</th>
                        <th>state</th>
                        <th>zip</th>
                        <th>status</th>
                        <th>transaction_id</th>
                        <th>currency</th>
                         <th>Pdf_download</th>
                        <th>send_email</th>
                        <th>orders_details</th>
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($data as $key=> $data)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->amount }}</td>
                            <td>{{ $data->address }}</td>
                            <td>{{ $data->address_2 }}</td>
                            <td>{{ $data->country }}</td>
                            <td>{{ $data->state }}</td>
                            <td>{{ $data->zip }}</td>
                            <td>{{ $data->status }}</td>
                            <td>{{ $data->transaction_id }}</td>
                            <td>{{ $data->currency }}</td>
                            <td><a class="btn btn-primary" href="{{ route('pdf_download.home', $data->id) }}">Pdf_download</a></td>
                            <td><a class="btn btn-info" href="{{ route('send_email.home', $data->id) }}">Send_email</a></td>
                            <td><a class="btn btn-primary" href="{{ route('order_detail.home', $data->id) }}">details......</a></td>
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


