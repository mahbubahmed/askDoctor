<!DOCTYPE html>
<html>
    <head>
        <title>Authentication System</title>        
    </head>

    <body>
        @if(Session::has('global'))
        <p>{{ Session::get('global')}}</p>
        @endif
        
        @include('layout.navigation')
        @yield('content')
  
    </body>


</html>