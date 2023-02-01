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
           <h1 class="allcate">All Categroy</h1><a class="addcate" href="{{ url('/category') }}">Add Categories</a>
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
                <table class="table">
                    <thead class="head">
                      <tr>
                        <th>id</th>
                        <th>categories</th>
                        <th>created</th>
                        <th>action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @forelse ($data as $sdata)
                       <tr>
                        <td>{{ $sdata->id }}</td>
                        <td>{{ $sdata->category_name }}</td>
                        <td>{{ $sdata->created_at }}</td>
                        <td>
                          <form action="{{ route('delete.home', $sdata->id) }}" method="get">
                          
                            @csrf
                           <button class="btn btn-danger">delete</button>
                          </form>
                        </td>
                       </tr>
                     @empty
                       <div class="alert alert-danger">
                        Data not found!
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


