<div class="panel panel-default">
<div class="panel-heading">Main Menu</div>
<ul id="sidebar" class="nav"> 
  <li><a href="{{ URL::route('doctor-home')}}">Browse Questions</a></li> 
  <li><a href="{{ URL::route('doctor-replies')}}">Replies ({{ Session::get('num_of_replies') }})</a></li>
  <li><a href="{{ URL::route('doctor-all-question-answered')}}">Questions Answered</a></li>    
  <li><a href="{{ URL::route('account-change-password')}}">Change Password</a></li>            
</ul>
 </div>
 
 