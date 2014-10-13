<div class="panel panel-default">
<div class="panel-heading">Main Menu</div>
<ul id="sidebar" class="nav">  
  <li><a href="{{ URL::route('patient-replies')}}">Replies ({{ Session::get('num_of_replies') }})</a></li>
  <li><a href="{{ URL::route('patient-questions')}}">Questions Answered</a></li>    
  <li><a href="{{ URL::route('account-change-password')}}">Change Password</a></li>            
</ul>
 </div>
 
 