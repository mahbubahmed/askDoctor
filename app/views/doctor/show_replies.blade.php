@extends('layout.main')
@section('content')
<div class="col-md-12"><hr></div>
<div class="col-md-3">
@include('layout.doctor-sidebar')
</div>

<div class="col-md-9">

<div class="panel panel-default">
<div class="panel-heading">Replies To Your Answer</div>
<div class="list-content">
@if(count($records) > 0)		
<table class="table">
    <thead>
        <tr>
           
            <th>Unread Messages</th>
                      
        </tr>
    </thead>
    <tbody>   
    @foreach ($records as $row)    
        <tr>            
            <td>You have a <a href="{{ URL::to('/') }}/doctor/question/answer/{{ $row->question_id }}#comment{{ $row->comment_id}}">reply</a> to
            	{{$row->question_title }} <span class="post-time">Posted: {{ $row->created_at->diffForHumans() }}</span>
            </td>            
            
        </tr>
        
     @endforeach
    </tbody>
</table>

@else
	<div style="padding:20px;">You have no new replies.</div>
	
 @endif
</div>
</div>
</div>

@stop