@extends('layout.main')
@section('content')
<form action="{{ URL::route('account-sign-in-post')}}" method="post">
    
    <div class="field">
        Email : <input type="text" name="email" {{ (Input::old('email')) ? 'value = "' . Input::old('email').'"' :'' }} >
        
        @if($errors->has('email'))
            {{ $errors->first('email')}}
        @endif
        
    </div>
    
    
     <div class="field">
        Password : <input type="password" name="password" >
        
        @if($errors->has('password'))
            {{ $errors->first('password')}}
        @endif
    </div>
    
     <div class="field">
         Password : <input type="checkbox" name="remember" id="remember" >
         <label for="remember">Remember Me</label>
    </div>
    
    
    <input type="submit" value="Sign In">
    {{Form::token()}}
    
</form>

@stop