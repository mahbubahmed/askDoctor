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
<div class="panel-heading">Patient's Question Details</div>
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

@if($records[0]->attachment)	
<div> 
Attachment: <a target="_blank" href="{{ URL::to('/') }}/{{Config::get('app.upload_attachment_url')}}{{$records[0]->attachment}}">View Attachment</a>
</div>
@endif

 <div class="btn-group pull-right">
    <button type="button" class="btn btn-default">Answer This Question</button>
  </div>



</div>

@stop