<?php
class DoctorController extends BaseController {
	
	public function index()
	{
		$row = DB::table('doctors')->where('user_id', '=', Auth::user()->id )->select('selected_categories')->first();
		
		$data['records'] = Question::where('doctor_id', '=', '0')
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
}