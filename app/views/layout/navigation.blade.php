<div class="col-md-12">
   <div id="header">
      <nav>
         <ul class="nav nav-pills pull-right">
            <li class="active"><a href="{{ URL::route('home')}}">Home</a></li>
            @if(Auth::check())
            	 @if(strtolower(Auth::user()->userable_type) == 'doctor')  
            		<li><a href="{{ URL::route('doctor-home')}}">My Account</a></li>
            	 @else
            	 	@if(Auth::user()->user_type == '1')
            	 	<li><a href="{{ URL::route('patient-ask')}}">My Account</a></li>
            	 	@endif
            	 	@if(Auth::user()->user_type == '2')
            	 	<li><a href="{{ URL::route('doctor-home')}}">My Account</a></li>
            	 	@endif
            	 @endif	           
            <li><a href="{{ URL::route('account-sign-out')}}">Sign Out</a></li>
            @else
            <li><a href="{{ URL::route('account-sign-in')}}">Sign In</a></li>
            <li><a href="{{ URL::route('account-create')}}">Create an account</a></li>
            @endif
         </ul>
      </nav>
      <div id="logo">{{ HTML::image('assets/images/bd.png', 'Logo') }}</div>
   </div>
</div>