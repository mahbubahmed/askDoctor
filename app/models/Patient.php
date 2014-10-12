<?php
class Patient extends Eloquent {
	
	protected $fillable = array('user_id', 'patient_age');
	protected $table = "patients";
	
	public function user()
    {
        return $this->belongsTo('User', 'id','user_id');
    }
}