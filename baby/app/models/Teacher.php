<?php

class Teacher extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
        
        public function dog() {
            
            return "hello";
        }
        
}
