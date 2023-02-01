

@extends('admin.app')

@section('body')

<style>

.main-panel{
        width: 1145px;
        margin-left: -14px;
   }
 
</style>
<div class="main-panel">
    <div class="content-wrapper">
       <div class="row justify-content-center">
        <div class="card col-lg-10">
          <div class="card-header">
           <h1 class="allcate">{{ $user->email }}</h1>
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
               
                <form action="{{ route('send_user_email.home', $user->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label>Email greeting : </label>
                      <input type="text" name="greeting" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>First Name : </label>
                        <input type="text" name="first_name" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Email Body : </label>
                        <input type="text" name="body" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Email Button : </label>
                        <input type="text" name="button" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Email Url : </label>
                        <input type="text" name="url" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Last Name : </label>
                        <input type="text" name="last_name" class="form-control">
                      </div>
                      <button style="background-color: blue;" type="submit" class="btn btn-primary">Submit</button>
                  </form>
              
                 
             </div>
           </div>
       </div>
    </div>
</div>
@endsection


