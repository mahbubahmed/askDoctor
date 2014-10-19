@extends('layout.main')
@section('content')

<div class="col-md-7">
<h3>Sign In</h3> 
<hr>


<form class="form-horizontal" role="form" action="{{ URL::route('account-sign-in-post')}}" method="post">
    
     <div class="form-group">
    	<label for="email" class="col-sm-3 control-label">Email</label>
    	<div class="col-sm-5">
        <input type="email" name="email" class="form-control" {{ (Input::old('email')) ? 'value = "' . Input::old('email').'"' :'' }} >
        </div>
        <div class="col-sm-4 error">
        @if($errors->has('email'))
            {{ $errors->first('email')}}
        @endif
        </div>
    </div>
  
    
     <div class="form-group">
     <label for="password" class="col-sm-3 control-label">Password</label>
     <div class="col-sm-5">     
       <input type="password" name="password" class="form-control" >
      </div> 
       <div class="col-sm-4 error"> 
        @if($errors->has('password'))
            {{ $errors->first('password')}}
        @endif
        </div>
    </div>
    
    <!-- 
    <div class="col-sm-offset-4 col-sm-9">
    <div class="checkbox">
    	<label for="remember">
         <input type="checkbox" name="remember" id="remember" >
         Remember Me
         </label>
    </div>
    </div>
     -->
     
    <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default">Sign In</button>
    </div>
  </div>
    {{Form::token()}}
    
</form>
</div>

@stop