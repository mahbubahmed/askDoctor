<?php
use Illuminate\Support\Facades\Auth;
class DoctorController extends BaseController {
	
	function __destruct(){
	
		Session::put('num_of_replies', $this->get_number_of_replies() );
	}
	
	public function index()
	{
		$row = DB::table('doctors')->where('user_id', '=', Auth::user()->id )->select('selected_categories')->first();
		
		$data['records'] = Question::where('doctor_id', '=', NULL)
										->whereIn('category_id', array($row->selected_categories))
										->orderBy('question_id', 'DESC')
										->paginate(15, array('question_id','question_title','created_at') );
		
		return View::make('doctor/index',$data);
	}
	
	public function view_question($id)
	{
		$data['records'] = Question::where('question_id', '=', $id)->get(); 
		return View::make('doctor/show_details',$data);
		
	}
	
	public function answer_question_get($id)
	{
		
		$question = DB::table('questions')->where('question_id', '=', $id )->first();
						
	
		if( $question->doctor_id == Auth::user()->id ||  ($question->doctor_id == NULL) )
		{		
			 if($question->doctor_id == Auth::user()->id)
			 {
				//Get all comments/replies from comments table
				$data['comment'] = Comment::where('question_id', '=', $id)
				->select('users.id', 'users.username','user_type', 'comment_id', 'comment','comments.created_at')
				->leftJoin('users', 'users.id', '=', 'comments.user_id')
				->orderBy('comment_id', 'ASC')
				->get();				
				
				// Get Doctors Information
				$data['doctor'] = Doctor::where('user_id', '=', $question->doctor_id)
				->select('profile_img', 'doctor_degree')
				->first();
				
				// Have to mark reply as read
				// Mark Replies as Read
				Comment::where('comments.question_id', '=', $id)
				->where('comments.user_id', '!=', Auth::user()->id)
				->update(array('viewed' => 1));
			 }	
				
				$data['row'] = $question;
				return View::make('doctor/answer', $data);
				
		}		
		else
		{
			return Redirect::route('doctor-question-view',array('id'=>$id))->with(array(
						'type'=>'danger', 
						'msg'=>'Somebody has already answered to this question'
			));
		}
	}
	
	public function answer_question_post()
	{
	
		$validator = Validator::make(Input::all(), array(
				'answer' => 'required',
				'questionID' => 'required',
		));
		
		if ($validator->fails())
		{
			
			return Redirect::route('doctor-question-answer',array('id'=> Input::get('questionID') ))
									->withErrors($validator)->withInput();
		}
		else
		{
			
			$question = DB::table('questions')->select('doctor_id')->where('question_id', '=', Input::get('questionID')  )->first();
								
			if($question->doctor_id == Auth::user()->id || $question->doctor_id = NULL)
			{				
				// Insert Answer and Update Question table
				DB::beginTransaction();
				try
				{
				
					if(!Input::get('is_question_booked')):
					// Update Question Table
					DB::table('questions')->where('question_id', '=', Input::get('questionID')  )
					->update(array('doctor_id' => Auth::user()->id ));
					endif;
						
					// Post Answer to the question
					$comment = new Comment();
					$comment->comment = Input::get('answer');
					$comment->viewed = false;
					$comment->user_id = Auth::user()->id;
					$comment->question_id = Input::get('questionID') ;
					$comment->save();
						
				}
				catch (Exception $e)
				{
					DB::rollback();
					//Redirect to Doctor's Homepage
					return Redirect::route('doctor-home')->with(array(
							'type'=>'danger',
							'msg'=>'Could not post your answer due to a technical problem.'
					));
				}
				
				DB::commit();
				return Redirect::route('doctor-question-answer',array('id'=> Input::get('questionID') ));						
			}
			else 
			{			
				//Redirec to Doctor's Homepage
				return Redirect::route('doctor-home')->with(array(
						'type'=>'danger',
						'msg'=>'Somebody has already answered to this question'
				));
			}			
			
		}
		
		
		
	}
	
	public function replies_get()
	{
		$data['records'] = Comment::where('questions.doctor_id', '=', Auth::user()->id )							
							->leftJoin('questions', 'questions.question_id', '=', 'comments.question_id')							
							->select('comment_id', 'comment','viewed', 'comments.created_at','question_title','comments.question_id')
							->where('comments.viewed', '=', 0)
							->where('comments.user_id', '!=', Auth::user()->id)->get();

		return View::make('doctor/show_replies',$data);
	}
	
	public function question_answered_get()
	{
		$data['records'] = Question::where('doctor_id', '=', Auth::user()->id)
		->orderBy('question_id', 'DESC')
		->paginate(15, array('question_id','question_title','created_at') );
	
		return View::make('doctor/show',$data);
	
	}
	
	
	public function get_number_of_replies()
	{
	
		return DB::table('comments')->where('questions.doctor_id', '=', Auth::user()->id )
		->leftJoin('questions', 'questions.question_id', '=', 'comments.question_id')
		->where('viewed', '=', 0)
		->where('comments.user_id', '!=', Auth::user()->id)
		->count();
	
	}
	
}