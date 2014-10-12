<nav>
    <ul>
        <li><a href="{{ URL::route('home')}}">Home</a></li>
        
        @if(Auth::check())
            <li><a href="{{ URL::route('account-sign-out')}}">Sign Out</a></li>
            <li><a href="{{ URL::route('account-change-password')}}">Change Password</a></li>
        @else
            <li><a href="{{ URL::route('account-sign-in')}}">Sign In</a></li>
            <li><a href="{{ URL::route('account-create')}}">Create an account</a></li>
        @endif
        
    </ul>
</nav>