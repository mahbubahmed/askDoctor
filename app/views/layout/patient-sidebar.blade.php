<div class="panel panel-default">
<div class="panel-heading">Main Menu</div>
<ul id="sidebar" class="nav">
  <li><a href="{{ URL::route('patient-ask')}}">Ask Question</a></li>
  <li><a href="{{ URL::route('patient-replies')}}">Replies ({{ Session::get('num_of_replies') }})</a></li>
  <li><a href="{{ URL::route('patient-questions')}}">Questions</a></li>
  <li><a href="{{ URL::route('account-sign-in')}}">Submit A Ticket</a></li>  
  <li><a href="{{ URL::route('account-change-password')}}">Change Password</a></li>            
</ul>
 </div>
 
 