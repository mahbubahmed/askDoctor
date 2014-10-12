<?php

Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home',
));

Route::get('/student',array(
    
    'as' =>'student',
    'uses' => 'StudentController@getStudent'
    
));



/*
 * Authenticated Group
 */

Route::group(array('before'=>'auth'), function(){
    
     /*
     * CSRF Protection group
     */
    Route::group(array('before' => 'csrf'), function() {
            
        /* Change Password (POST) */

        Route::post('/account/change-password', array(
            'as' => 'account-change-password-post',
            'uses' => 'AccountController@postChangePassword'
        ));
    });
    
    
    
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



Route::resource('teachers', 'TeachersController');