<?php
class Comment extends Eloquent {
	
	protected $fillable = array('comment','user_id','question_id','viewed');
	protected $table = "comments";
	protected $primaryKey = 'comment_id';
	
	public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }
    
    public function question()
    {
    	return $this->hasOne('Question');
    }
}