@extends('layout.main')
@section('content')
     
<div class="col-md-12"><hr></div>

<div class="col-md-3">
@include('layout.doctor-sidebar')
</div>


<div class="col-md-9">
<div class="panel panel-default">
<div class="panel-heading">Change Your Password</div>
<div style="padding: 10px;">

@if(Session::has('global'))
 <div class="alert alert-{{ Session::get('type') }}" role="alert" >
    <a href="#" class="close" data-dismiss="alert">&times;</a>
	<p>{{ Session::get('global')}}</p>
</div>	
 @endif

<form class="form-horizontal" role="form" action="{{URL::route('account-change-password')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
    
    <div class="form-group">
	    <label for="oldpassword" class="col-sm-3 control-label">Old Password</label>	
	    <div class="col-sm-5">
	         <input class="form-control" type="password" name="old_password">
	     </div>
	      <div class="col-sm-4 error">    
	        @if($errors->has('old_password'))  
	            {{ $errors->first('old_password') }}            
	        @endif    
	     </div>   
    </div>  

   <div class="form-group">
	   	<label for="newpassword" class="col-sm-3 control-label">New Password</label>
	   	<div class="col-sm-5">	
	        <input class="form-control" type="password" name="password">
	    </div> 
	    <div class="col-sm-4 error">     
	        @if($errors->has('password'))  
	            {{ $errors->first('password') }}            
	        @endif  
	    </div>  
    </div>  

    <div class="form-group">
    	<label for="oldpassword" class="col-sm-3 control-label">New Password Again</label>	
    	<div class="col-sm-5">	
        <input class="form-control" type="password" name="password_again">
        </div>
         <div class="col-sm-4 error">
        @if($errors->has('password_again'))  
            {{ $errors->first('password_again') }}            
        @endif  
        </div>
    </div>  
    
    <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default">Change Password</button>
    </div>
  </div>
    {{Form::token()}}
</form>

</div>
</div>

</div>
@stop