@extends('layout.main')
@section('content')
<div class="col-md-12"><hr></div>

<div class="col-md-3">
@include('layout.doctor-sidebar')
</div>

<div class="col-md-9" >
<div class="panel panel-default">
<div class="panel-heading">Select a date range</div>
<div style="padding: 40px;">

@if(Session::has('msg'))
 <div class="alert alert-success" role="alert" >
    <a href="#" class="close" data-dismiss="alert">&times;</a>
	<p>{{ Session::get('msg')}}</p>
</div>	
 @endif

@if($errors->has())    
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger" role="alert" >
      	<a href="#" class="close" data-dismiss="alert">&times;</a>
      	{{ $error }}
      </div>
  @endforeach
 @endif


<form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data" autocomplete="off">
   
  <div class="form-group">
    <label for="questionTitle">From Date</label>
    <input type="date" name="date_from" class="form-control" id="datepicker1" data-date-format="dd-mm-yyyy" {{ (Input::old('date_from')) ? ' value="' .e(Input::old('date_from')) . ' "' : ''  }} >
  </div>
  
  <div class="form-group">
    <label for="questionTitle">To Date</label>
    <input type="date" name="date_to" class="form-control" id="datepicker2" data-date-format="dd-mm-yyyy" {{ (Input::old('date_to')) ? ' value="' .e(Input::old('date_to')) . ' "' : ''  }} >
  </div>
  
  <button type="submit" class="btn btn-default pull-right">Submit</button>
   {{Form::token()}}
</form>

</div>
</div>
</div>

<script>
 
$(document).ready(function() {
	
	// Datepicker
	var myDate = new Date();
	var currentDate = myDate.getDate() + '-' +(myDate.getMonth()+1) + '-' +  myDate.getFullYear();
	$('#datepicker1').datepicker();
	$('#datepicker2').datepicker("setDate", currentDate);
	
	
});

</script>

@stop