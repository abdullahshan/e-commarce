@extends('admin.app')

@section('body')

<style>

.main-panel{
        width: 1145px;
        margin-left: -14px;
   }


    .header{

        font-size: 40px;
        font-weight: bold;
    }

    .allcate{
        
        background-color: rgb(7, 216, 199);
        margin-left: 10px;
        padding: 10px;
        border-radius: 5px;
      
    }
    .card-header{
        display: flex;
        align-items: center;
    }
    .card-header a{
        text-decoration: none;
    }
    
</style>

<div class="main-panel">
    <div class="content-wrapper">
       <div class="row justify-content-center">
        <div class="card col-lg-10">

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

          <div class="card-header">
            <h1 class="header">Add category</h1><a class="allcate" href="{{ route('allcategory.home') }}">All Categries</a>
          </div>
             <div class="card-body">
                 <form action="{{ route('addcategory.home') }}" method="get">
                  
                    @csrf
                     <div class="mb-3">
                       <label for="name" class="form-label">category</label>
                       <input type="text" name="cat_name"  placeholder="enter your category name" class="form-control">
                     </div>
                     <button type="submit" style="background-color:rgb(7, 216, 199)" class="btn btn-primary">submint</button>
                   </form>
             </div>
           </div>
       </div>
    </div>
</div>
@endsection


