@extends('layout.main')
@section('content')
<div class="col-md-12"><hr></div>

<div class="col-md-3">
@include('layout.patient-sidebar')
</div>

<div class="col-md-9" >
<div class="panel panel-default">
<div class="panel-heading">Your Question</div>
<div style="padding: 40px;">

@if(Session::has('global'))
 <div class="alert alert-{{ Session::get('type') }}" role="alert" >
    <a href="#" class="close" data-dismiss="alert">&times;</a>
	<p>{{ Session::get('global')}}</p>
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
    <label for="questionTitle">Title</label>
    <input type="text" name="question_title" class="form-control" id="question_title" placeholder="Title"  value="{{ (Input::old('question_title')) ? Input::old('question_title') : $records->question_title }}" >
  </div>
  
   <div class="form-group">
    <label for="questionTitle">Category</label>    
    {{ Form::select('category', $category , (Input::old('category')) ?  e(Input::old('category'))  : $records->category_id , array('id' => 'category', 'class' => 'form-control',  )) }}
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Question Details</label>
    <textarea name="question_details" class="form-control" rows="8">{{ (Input::old('question_details')) ?  e(Input::old('question_details'))  : $records->question_details  }}</textarea>
  </div>    
  
  
  <div id="img" style="display: none;"><span class="inside-img"></span> <a class="imagefile" href="#remove">Remove</a></div>
  
  
  
<div id="attach-image"></div>
  
  <button type="submit" class="btn btn-default pull-right">Submit</button>
   {{Form::token()}}
</form>
<!-- Button trigger modal -->
<button id="attachBtn"  class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Attach Image
</button>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <div class="modalForm">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload File</h4>
      </div>
      <div class="modal-body">             
       
       <form id="imageUploadForm" class="form-horizontal" role="form" action="{{URL::route('patient-postQuestion')}}" method="post" enctype="multipart/form-data" autocomplete="off">
		  
		  <div class="form-group">
		    <label for="attachment">File input</label>
		    <input type="file" class="filestyle" name="attachment" id="attachment">		    
		  </div>
		  <div class="status"></div>
		<button type="submit" class="btn btn-default">Upload</button>		  
		  
		</form>         
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<!-- Modal For Loading -->

<div id="Working_Modal" class="modal fade" tabindex="-1" role="dialog" data-keyboard="false"
         data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center">
                    <h3>Uploading File</h3>
                </div>
                <div class="modal-body" >
                    <div style="height:200px">
                      <span id="searching_spinner_center" style="position: absolute;display: block;top: 50%;left: 50%;"></span>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center"></div>
            </div>
        </div>
    </div>
</div>

<!--  End of Loading Modal -->

<script>

$(document).ready(function (e) {

     


	
    $('#imageUploadForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
		//Showing Loading Modal
        $('#Working_Modal').modal('show');
        
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            dataType: 'json',
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status == 1)
                {
                	$('#Working_Modal').modal('hide');                    
                	$(".status").html("");
                	$(".status").html(data.filename);
                	$( "#attach-image" ).append( '<input type="hidden" id="formImg" name="imagefile" value="'+ data.filename + '">' );
                	$( ".inside-img" ).append( data.originalname);
                	$( "#img" ).show();
                	$('#myModal').modal('hide'); 
                	$('#attachBtn').hide();
                }
                else
                {
                	$('#Working_Modal').modal('hide');
                	$(".status").html("");
                	$(".status").html(data.msg);
                }
                
            },
            error: function(data){
            	 $(".status").html('Upload Failed, Please try again.');
                
            }
        });
    }));


  //Delete File	
    $(".imagefile" ).click(function(e) {

    	e.preventDefault();  
		var targetFile = $("#formImg").val(); 			
        $.ajax({
            type:'POST',
            url: '<?php echo URL::to('/');?>/patient/delete-attachment',            
            data: "targetFile="+targetFile ,
            dataType: 'json',          
            success:function(data)
            {
                if(data.status == 1)
                {
                  	$('.inside-img').html("");
                	$('#formImg').val("");
                	$( "#img" ).hide(); 
                	$('#attachBtn').show();
                }
                else
                {
                	alert(data.msg);
                }
                
            },
            error: function(data){
            	 $(".status").html('Upload Failed, Please try again.');
                
            }
        });   	
    });
   // End of Delete File


    <?php if($records->attachment){ ?>
	var filename = '<?php echo $records->attachment ; ?>';
	$(".status").html("");
	$(".status").html(filename);
	$( "#attach-image" ).append( '<input type="hidden" id="formImg" name="imagefile" value="'+ filename + '">' );
	$( ".inside-img" ).append( filename);
	$( "#img" ).show();
	$('#myModal').modal('hide'); 
	$('#attachBtn').hide();
	
	
<?php }?>	
   
});

</script>
@stop