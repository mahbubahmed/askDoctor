<?php

class HomeController extends BaseController {

   
    
    public function home() {
        /*
          Mail::send('emails.auth.test', array('name'=>'Alex'),function($message){

          $message->to('mahbubahmed7@gmail.com', 'Mahbub Ahmed')->subject('Test Email');

          });
         */
        return View::make('home');
    }

}
