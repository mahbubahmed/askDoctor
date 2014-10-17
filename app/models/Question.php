<?php
class Question extends Eloquent {
	
	protected $table = "questions";
	protected $primaryKey = 'question_id';
	protected $fillable = array('question_title','question_tracking','question_details','attachment','patient_id','category_id','doctor_id');
	
	public function user()
    {
        return $this->belongsTo('User', 'patient_id', 'id');
    }
}