@extends('layout.main')
@section('content')
<div class="col-md-12"><hr></div>
<div class="col-md-3">
@include('layout.patient-sidebar')
</div>

<div class="col-md-9">

<div class="panel panel-default">
<div class="panel-heading">Your Questions</div>
<div class="list-content">
@if($records)	
<table class="table">
    <thead>
        <tr>
           
            <th>Title</th>
            <th>Post Date</th>          
        </tr>
    </thead>
    <tbody>   
    @foreach ($records as $row)    
        <tr>            
            <td><a href="{{ URL::to('/') }}/patient/questions/{{ $row->question_id }}">{{ $row->question_title }}</a></td>            
            <td>{{ $row->created_at->diffForHumans() }}</td>
        </tr>
     @endforeach
    </tbody>
</table>

@else
	<div>You have not asked any question yet.</div>
	
 @endif
<div><?php echo $records->links(); ?></div>
</div>
</div>

</div>

@stop