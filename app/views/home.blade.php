@extends('layout.main')
@section('content')
   
   
 <div class="col-md-12"> 
   <div id="carousel" class="carousel slide" data-ride="carousel">
      <!-- Menu -->
      <ol class="carousel-indicators">
         <li data-target="#carousel" data-slide-to="0" class="active"></li>
         <!--<li data-target="#carousel" data-slide-to="1"></li> -->
      </ol>
      <!-- Items -->
      <div class="carousel-inner">
         <div class="item active">
            {{ HTML::image('assets/images/slide-two.jpg', 'Slide 1') }}
             <div class="carousel-caption">
             	<h1 style="color: #5ABDCD; font-weight:bold;">Ask The Doctor</h1>
			    <h1>Expert doctors, Quick Replies.</h1>
			    <h3>Online Consultations by Board-Certified and Experienced Doctors in over 40 Specialities. </h3>			    	   
  			</div>
         </div>
         <!-- 
         <div class="item">
            {{ HTML::image('assets/images/slide-two.jpg', 'Slide 2') }}
             <div class="carousel-caption">
			    <div class="first-caption">Medical Services That </div>
			    <div class="second-caption">Medical Services That </div>		   
  			</div>
         </div>
         -->
      </div>
      <a href="#carousel" class="left carousel-control" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a href="#carousel" class="right carousel-control" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
   </div>
</div>  
 
 <div class="col-md-12">
 <p>

 </p>
 
 
 </div>
   
   <!-- 
   
   <h3>Hello</h3>
    @if(Auth::check())
    <p>Hello, {{ Auth::user()->username}} </p>
    @else
    <p>You are not Signed in.</p>
    @endif
    
     -->
@stop    