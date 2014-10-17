@extends('layout.main')
@section('content')
<div class="col-md-12"><hr></div>

<div class="col-md-3">
@include('layout.doctor-sidebar')

</div>

<div class="col-md-9">

@if(Session::has('msg'))
 <div class="alert alert-{{ Session::get('type') }}" role="alert" >
    <a href="#" class="close" data-dismiss="alert">&times;</a>
	<p>{{ Session::get('msg')}}</p>
</div>	
 @endif

<div class="panel panel-default">
<div class="panel-heading">Patient Question</div>
<div style="padding: 10px;">
	@if($row)		
			<div><span class="question-track-id">Tracking ID: {{$row->question_tracking}}</span><h3>{{$row->question_title}}</h3><hr></div>
			<div><p>{{ nl2br($row->question_details) }}</p></div>		
	@else
	<div>Sorry, No Records Found</div>	
	 @endif 
</div>        
   
</div>

<div> 
@if($row->attachment)	
Attachment: <a target="_blank" href="{{ URL::to('/') }}/{{Config::get('app.upload_attachment_url')}}{{$row->attachment}}">View Attachment</a>
@endif
</div>


<br>


<!--  Doctor Answer Form -->
<div class="panel panel-default">
<div class="panel-heading">Submit Your Answer</div>
<div style="padding: 30px;">	@if($errors->has('answer'))
	<div class="error" style="margin-bottom: 10px;" >     	
	    {{ $errors->first('answer')}}    
    </div>
    @endif
    
	<form class="form-horizontal" role="form" action="{{route('doctor-question-answer-post')}}" method="post" enctype="multipart/form-data" autocomplete="off">	 
	  <div class="form-group">
	  <input type="hidden" name="is_question_booked" value="{{ $row->doctor_id }}">	  
	  <input type="hidden" name="questionID" value="{{ $row->question_id }}">  
	    <textarea name="answer" class="form-control" rows="8">{{ (Input::old('answer')) ? e(Input::old('answer')) : ''  }}</textarea>
	  </div>
	   <button type="submit" class="btn btn-default">Submit</button>
	   {{Form::token()}}
	</form>

</div>
</div>
<!--  End of Doctor Answer Form -->


<!-- Begining of Replies/Comments/Answer -->
@if($row->doctor_id == Auth::user()->id )			
<div class="panel panel-default">
<div class="panel-heading">Replies</div>
	<div style="padding: 10px;">
	@if(!$comment->isEmpty())	
		 @foreach ($comment as $row)
		 	<div class="row" id="comment{{$row->comment_id}}">
		 	
		 		<div class="col-md-3" style="border-right: 1px solid #eee; min-height: 150px;">
		 		@if($row->user_type == '2')
		 		<img src="{{ URL::to('/') }}/assets/doctors/{{ $doctor->profile_img }}" alt="doctor" class="img-thumbnail">
		 		<p class="commenter">{{$row->username}}</p>
		 		@else
		 		<img src="{{ URL::to('/') }}/assets/patient/default.jpg" alt="patient" class="img-thumbnail">
		 		<p class="commenter">{{$row->username}}</p>
		 		@endif	
		 		</div>  
				<div class="col-md-9"><p>{{ nl2br($row->comment) }}</p></div>
				
			</div>
			<div class="col-sm-offset-3 col-md-9 post-time">Posted: {{$row->created_at->diffForHumans()}}</div>
			<hr>
			
			 @endforeach
			
	@else
	<div>Sorry, You have no replies yet.</div>	
	@endif 
	</div>
	
</div>
@endif
<!-- End of Replies/Comments/Answer -->




</div>

@stop