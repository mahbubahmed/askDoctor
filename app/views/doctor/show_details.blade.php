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
		 <span id="url" style="display: none;">{{url("/doctor/question/answer")}}/{{ $records[0]->question_id }}</span>
		 
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

@if(!$records->isEmpty())
  @if(empty($records[0]->doctor_id))		
  <div class="btn-group pull-right">    
    <a type="button" class="btn btn-default" href="#" data-id="" data-toggle="modal" data-target="#confirmDelete" data-message="Are you sure you want to delete this item ?">
    Answer This Question
    </a>
  </div>
   @endif 
 @endif   
  
  
</div>


<!-- Answer Confirm Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Answer This Question</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to answer this question ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Answer Confirm Dialog -->

<script>
<!-- Form confirm (yes/ok) handler, submits form -->
$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
    
	  	$('#confirmDelete').modal('hide');	  	  	
	  	window.location.href = $("#url").text();	

	  	
});
    </script>

@stop