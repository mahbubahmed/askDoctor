@extends('layout.main')
@section('content')
<div class="col-md-12"><hr></div>

<div class="col-md-3">
@include('layout.patient-sidebar')

<div class="panel panel-default">
<div class="panel-heading">Submit Your Comment</div>
<div style="padding: 30px;">	@if($errors->has('reply'))
	<div class="error" style="margin-bottom: 10px;" >     	
	    {{ $errors->first('reply')}}    
    </div>
    @endif
    
	<form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data" autocomplete="off">	 
	  <div class="form-group">	    
	    <textarea name="reply" class="form-control" rows="8">{{ (Input::old('reply')) ? ' value="' .e(Input::old('reply')) . ' "' : ''  }}</textarea>
	  </div>
	   <button type="submit" class="btn btn-default">Submit</button>
	   {{Form::token()}}
	</form>

</div>
</div>


</div>

<div class="col-md-9">


@if(Session::has('msg'))
 <div class="alert alert-{{ Session::get('type') }}" role="alert" >
    <a href="#" class="close" data-dismiss="alert">&times;</a>
	<p>{{ Session::get('msg')}}</p>
</div>	
 @endif

<div class="panel panel-default">
<div class="panel-heading">Your Question</div>
<div style="padding: 10px;">
	@if(!$records->isEmpty())	
		 @foreach ($records as $row)  
			<div><span class="question-track-id">Tracking ID: {{$row->question_tracking}}</span><h3>{{$row->question_title}}</h3><hr></div>
			<div><p>{{ nl2br($row->question_details) }}</p></div>
		 @endforeach
	@else
	<div>Sorry, No Records Found</div>	
	 @endif 
</div>        
   
</div>

<div> 
@if($records[0]->doctor_id == 0)
	<a href="{{ URL::to('/') }}/patient/question/edit/{{$records[0]->question_id}}">Edit Question</a>
@endif

@if($records[0]->attachment)	
Attachment: <a target="_blank" href="{{ URL::to('/') }}/{{Config::get('app.upload_attachment_url')}}{{$records[0]->attachment}}">View Attachment</a>

@endif
</div>


<br>
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
	<div>Sorry, You have no replies to your question yet.</div>	
	@endif 
	</div>
	
</div>

</div>

@stop