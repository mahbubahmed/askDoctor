<?php
class PatientController extends BaseCOntroller {
	
	function __destruct(){
		
		Session::put('num_of_replies', $this->get_number_of_replies() );
	}
	
	public function ask_question()
	{
			
		$data['category'] = DB::table('category')->orderBy('category_name', 'ASC')->lists('category_name','category_id');
		$data['category'][''] = 'Select a category (Optional)';		
		return View::make('patient/index', $data);		
	}
	
	public function add_question()
	{
		$validator = Validator::make(Input::all(), array(
				'question_title' => 'required|max:150|min:10',
				'question_details' => 'required|min:10',				
		
		));
		$niceNames = array(
				'question_title' => 'Title',
				'question_details' => 'Question Details'
		);
		$validator->setAttributeNames($niceNames);
		
		if ($validator->fails())
		{
			return Redirect::route('patient-ask')->withErrors($validator)->withInput();
		}
		else
		{
			//Generating Question Tracking Number
			$time = substr( time() , -4);
			$question_tracking_num = $time."-".rand();
			
			$question = new Question();
			$question->question_tracking = $question_tracking_num;
			$question->question_title = Input::get('question_title');
			$question->question_details = Input::get('question_details');
			$question->attachment = Input::get('imagefile');
			$question->category_id = Input::get('category');			
			
			$user = Auth::user();
			$user->question()->save($question);
			return Redirect::route('patient-ask')
			->with('global', 'Your question has been sucessfully posted. Please wait for answer.');
		}
		
	}
	
	public function get_question()
	{
		$data['records'] = $someUsers = Question::where('patient_id', '=', Auth::user()->id)
										->orderBy('question_id', 'DESC')
										->paginate(15, array('question_id','question_title','created_at') );
		
		return View::make('patient/show',$data);
		
	}
	
	public function get_question_details($id = NULL)
	{
		$data['records'] = Question::where('question_id', '=', $id)->get(); 				
		$data['comment'] = Comment::where('question_id', '=', $id)
							->select('users.id', 'users.username','user_type', 'comment_id', 'comment','comments.created_at')
							->leftJoin('users', 'users.id', '=', 'comments.user_id')
							->get();

		// Mark Replies as Read
		Comment::where('comments.question_id', '=', $id)
		->where('comments.user_id', '!=', Auth::user()->id)
		->update(array('viewed' => 1));
		
		
		//Doctor Who answered the question
		$doctor_id = $data['records'][0]->doctor_id;
		$data['doctor'] = Doctor::where('user_id', '=', $doctor_id)
		->select('profile_img', 'doctor_degree')
		->first();		
		
		return View::make('patient/show_details',$data);
	}
	
	
	public function get_replies()
	{
		$data['records'] = Comment::where('questions.patient_id', '=', Auth::user()->id )
		->leftJoin('questions', 'questions.question_id', '=', 'comments.question_id')
		->select('comment_id', 'comment','viewed', 'comments.created_at','question_title','comments.question_id')
		->where('comments.viewed', '=', 0)
		->where('comments.user_id', '!=', Auth::user()->id)->get();
			
		return View::make('patient/show_replies',$data);
	}
	
	
	public function post_replies($id = NULL)
	{
				
		 $validator = Validator::make(Input::all(), array(
				'reply' => 'required',		
		
		));	
		
		
		if ($validator->fails())
		{
			
			return Redirect::route('patient-particular-questions',array('id'=>$id))->withErrors($validator)->withInput();
		}
		else
		{
							
			$comment = new Comment();
			$comment->comment = Input::get('reply');
			$comment->viewed = false;
			$comment->user_id = Auth::user()->id;
			$comment->question_id = $id;			
			$comment->save();
			
			return Redirect::route('patient-particular-questions',array('id'=>$id));
		} 
	}
	
	public function edit_question_get($id = NULL)
	{
		
		$data['records'] = Question::where('question_id', '=', $id)
		->select('question_id', 'question_title','question_details', 'attachment','doctor_id','category_id')
		->first();	
		
		if($data['records']->doctor_id != 0):		
			return Redirect::route('patient-particular-questions',$id)
			->with(array('type'=>'danger', 'global'=>'You cannot edit your question anymore. Please submit a comment instead.'));
		endif;
		
		$data['category'] = DB::table('category')->orderBy('category_name', 'ASC')->lists('category_name','category_id');
		$data['category'][''] = 'Select a category (Optional)';
		
		return View::make('patient/edit_question', $data);
		
	}
	
	public function edit_question_post($id = NULL)
	{
		$validator = Validator::make(Input::all(), array(
				'question_title' => 'required|max:150|min:10',
				'question_details' => 'required|min:10',
		
		));
		$niceNames = array(
				'question_title' => 'Title',
				'question_details' => 'Question Details'
		);
		$validator->setAttributeNames($niceNames);
		
		if ($validator->fails())
		{
			return Redirect::route('patient-question-edit')->withErrors($validator)->withInput();
		}
		else
		{
							
			$question = Question::where('question_id', '=', $id)
			->where('patient_id', '=', Auth::user()->id)
			->update(array(
					'question_title'=> Input::get('question_title'),
					'question_details'=> Input::get('question_details'),
					'attachment'=> Input::get('imagefile'),
			));			
			
	
			return Redirect::route('patient-question-edit',$id)			
			->with(array('type'=>'success', 'global'=>'Your question has been sucessfully edited')); 
			
			echo Input::get('imagefile');
		}
	}
	
	
	public function uploadFile()
	{
		
		if (Input::hasFile('attachment'))
		{
			$file 		= Input::file('attachment');
			$extension  = $file->getClientOriginalExtension();
			
			if( $file->getSize() <= 1048576 ) // 1 MB
			{
				if($this->check_extension($extension))
				{				
					//Original Name
					$originalname = $file->getClientOriginalName();
					$destinationPath    = Config::get('app.upload_attachment_url'); 
								
					$filename           = time().'.'.$extension;
					$file->move($destinationPath, $filename);
					
					echo json_encode(array('status'=>'1', 'filename'=> $filename, 'originalname'=> $originalname ));
				}
				else 
				{
					echo json_encode(array('status'=> 2, 'msg' => 'Wrong File Format'));
				}
			}
			else
			{				
				echo json_encode(array('status'=> 2, 'msg' => 'File should be less than 1 MB'));
			}
		
		}
		else 
		{
			echo json_encode(array('status'=> 2, 'msg' => 'No file was selected'));
		}
		
		
	}
	
	public function delete_uploaded_file()
	{	
		$path = Config::get('app.upload_attachment_url').Input::get('targetFile');
		
		if(file_exists($path))
		{
			if(unlink($path))
			{
				echo json_encode(array('status'=> 1));
			}
			else 
			{
				echo json_encode(array('status'=> 2,'msg'=> 'Could not delete the file, please try again later.'));
			}
		}
		else 
		{
			echo json_encode(array('status'=> 2,'msg'=> 'Could not delete the file, please try again later.'));
		} 	 
		
	}
	
	public function get_number_of_replies()
	{
		
		return Comment::where('questions.patient_id', '=', Auth::user()->id )
		->leftJoin('questions', 'questions.question_id', '=', 'comments.question_id')
		->where('viewed', '=', 0)		
		->where('comments.user_id', '!=', Auth::user()->id)
		->count();
		
	}
	
	public function check_extension($ext)
	{
		$preffered_extension = array('png','jpg','jpeg');
		
		return (in_array($ext, $preffered_extension)) ? true : false;	
		
	}
}