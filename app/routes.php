<?php

Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home',
));


/*
 * Authenticated Group
 */

Route::group(array('before'=>'auth'), function(){
    
         
    
    // ---------------------- Filtering Patient ----------------------
    Route::group(array('before' => 'role-patient'), function() { 
    	
    	// Ask Question GET
    	Route::get('/patient/ask', array(
    	'as'    => 'patient-ask',
    	'uses'  => 'PatientController@ask_question'
    	));
    	
    	// Question List GET
    	Route::get('/patient/questions', array(
    	'as'    => 'patient-questions',
    	'uses'  => 'PatientController@get_question'
    	));
    	
    	// Question Details GET
    	Route::get('/patient/questions/{id}', array(
    	'as'    => 'patient-particular-questions',
    	'uses'  => 'PatientController@get_question_details'
    	))->where('id', '[0-9]+');
    	
    	
    	// Replies List GET
    	Route::get('/patient/replies', array(
    	'as'    => 'patient-replies',
    	'uses'  => 'PatientController@get_replies'
    	));
    	
    	// Edit Question GET
    	Route::get('/patient/question/edit/{id}', array(
    	'as'    => 'patient-question-edit',
    	'uses'  => 'PatientController@edit_question_get'
    	))->where('id', '[0-9]+');
    	
    	
    	// Edit Question POST
    	Route::post('/patient/question/edit/{id}', array(
    	'as'    => 'patient-question-post',
    	'uses'  => 'PatientController@edit_question_post'
    			))->where('id', '[0-9]+');
    	
   		
		// Upload Attachment/ Image 
	    Route::post('/patient/postQuestion', array(
	    	'as'    => 'patient-postQuestion',
	    	'uses'  => 'PatientController@uploadFile'
	    ));
	    
	    // Delete Attachment/ Image
	    Route::post('/patient/delete-attachment', array(
	    'as'    => 'delete-attachment',
	    'uses'  => 'PatientController@delete_uploaded_file'
	    ));
	    
    
	    // ----------  Patient CSRF Protection group -----
	    Route::group(array('before' => 'csrf'), function() {
	    
	    	// SUBMIT Question POST
	    	Route::post('/patient/ask', array(
	    	'as'    => 'patient-ask-submit',
	    	'uses'  => 'PatientController@add_question'
	    	));
	    	
	    	
	    	// Submit Comments/Message POST
	    	Route::post('/patient/questions/{id}', array(
	    	'as'    => 'patient-particular-questions',
	    	'uses'  => 'PatientController@post_replies'
	    	))->where('id', '[0-9]+');
	    	
	    	
	    	
	    	
	    	
	    });
	    // ----------  End of Patient CSRF Protection group -----
	    
	 });
    // ------------------------- End of Filtering Patient -------------
    
    
    
      
    
    
    
    
    
    // ---------------------- Filtering Doctor ----------------------
    
    Route::group(array('before' => 'role-doctor'), function() {
    
    	Route::get('/doctor', array(
    	'as'    => 'doctor-home',
    	'uses'  => 'DoctorController@index'
    	));
    
    });
    // ------------------------- End of Filtering Doctor -------------
    	
    
    
    
    
//  -------------------------   Common Access -----------
    
	    /*Sign out (GET) */    
	    Route::get('/account/sign-out', array(
	        'as'        =>  'account-sign-out',
	        'uses'      =>'AccountController@getSignOut'
	        
	    ));
	    
	    
	    /*Change Password (GET) */    
	    Route::get('/account/change-password', array(
	        
	        'as'    => 'account-change-password',
	        'uses'  => 'AccountController@getChangePassword'
	    ));
	    
	    
		    // --------------------- CSRF Protection group ---------------------
		     
		    Route::group(array('before' => 'csrf'), function() {
		    
		    	/* Change Password (POST) */
		    
		    	Route::post('/account/change-password', array(
		    	'as' => 'account-change-password-post',
		    	'uses' => 'AccountController@postChangePassword'
		    	));
		    
		    
		    });		    
		    
		    // ---------------------- End of  CSRF Protection group --------------   
    
  
// ------------------------- End of  Common Access -----------  
    
});






/*
 * Unauthenticated Group
 */
Route::group(array('before' => 'guest'), function() {

    /*
     * CSRF Protection group
     */
    Route::group(array('before' => 'csrf'), function() {

        /*
         * Create Account (POST)
         */
        Route::post('/account/create', array(
            'as' => 'account-create-post',
            'uses' => 'AccountController@postCreate'
        ));
        
         /* Sign In (POST) */
        Route::post('account/sign-in', array(
            'as' => 'account-sign-in-post',
            'uses' => 'AccountController@postSignIn'
        ));
    });
    
    
    
    
    
    /* Sign In (GET)*/
    Route::get('account/sign-in',array(
        
        'as'=>'account-sign-in',
        'uses'=>'AccountController@getSignIn'
    ));
    
    
    /*
     * Create Account (GET)
     */
    Route::get('/account/create', array(
        'as' => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));
    
    
    Route::get('/account/activate/{code}', array(
        
        'as' => 'account-activate',
        'uses' => 'AccountController@getActivate'
    ));
    
});



