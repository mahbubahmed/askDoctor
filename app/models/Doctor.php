<?php
class Doctor extends Eloquent {
	
	protected $fillable = array('user_id','doctor_degree');
	protected $table = "doctors";
	
	public function user()
    {
        return $this->belongsTo('User', 'id','user_id');
    }
}