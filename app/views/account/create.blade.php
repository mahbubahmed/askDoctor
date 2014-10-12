@extends('layout.main')
@section('content')

<div class="col-md-7">
<h3>Create an Account</h3> 
<hr>
<form class="form-horizontal" role="form" action="{{URL::route('account-create-post')}}" method="post" enctype="multipart/form-data" autocomplete="off">
    
        
    <div class="form-group">
    	<label for="Username" class="col-sm-3 control-label">Your Name</label>
    	<div class="col-sm-5">
        <input type="text" name="username" class="form-control" {{ (Input::old('username')) ? ' value="' .e(Input::old('username')) . ' "' : ''  }}>
        </div>
        <div class="col-sm-4 error">
        @if($errors->has('username'))
            {{ $errors->first('username')}}
        @endif  
        </div>
    </div>
    
    <div class="form-group">
        <label for="birthday" class="col-xs-3 control-label">Birthday</label>
        <div class="col-xs-5">
            <div class="form-inline">
                <div class="form-group" style="margin-left: -.3%;">
 
                {{ Form::select('day', $day, null, array('class' => 'form-control')) }}
                
                </div>
                <div class="form-group" style="margin-left: 4.5%;">
                
                {{ Form::select('month', $month, null, array('class' => 'form-control')) }}      
                
                </div>
                <div class="form-group" style="margin-left: 4.5%;">
                 {{ Form::select('year', $year, null, array('class' => 'form-control')) }}
                   
                </div>
            </div>
        </div>
        <div class="col-xs-4 error">
        @if($errors->has('day'))
            {{ $errors->first('day')}}
        @endif
        
         @if($errors->has('month'))
            {{ $errors->first('month')}}
        @endif
        
         @if($errors->has('year'))
            {{ $errors->first('year')}}
        @endif
        </div>
    </div> 
    
    
    <div class="form-group">
        <label for="Email" class="col-sm-3 control-label">Email</label>
         <div class="col-sm-5">
        <input type="email" name="email" class="form-control" {{  (Input::old('email'))  ? ' value="' . e(Input::old('email')) . '"' : ''  }}>
        </div>
        <div class="col-sm-4 error">
        @if($errors->has('email'))
            {{ $errors->first('email')}}
        @endif
        </div>
    </div>
 
    
    <div class="form-group">
    	<label for="Password" class="col-sm-3 control-label">Password</label>
    	<div class="col-sm-5">
        <input type="password" name="password" class="form-control">
        </div>
        <div class="col-sm-4 error">
         @if($errors->has('password'))
            {{ $errors->first('password')}}
        @endif
        </div>  
    </div>  
    
   <div class="form-group">
   		<label for="PasswordAgain" class="col-sm-3 control-label">Password Again</label>
   		<div class="col-sm-5">
        <input type="password" name="password_again" class="form-control" value="">
        </div>
        <div class="col-sm-4 error">
         @if($errors->has('password_again'))
            {{ $errors->first('password_again')}}
        @endif
        </div>  
    </div>  
    
    <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default">Create Account</button>
    </div>
  </div>
    {{Form::token()}}
</form>
</div>

@stop