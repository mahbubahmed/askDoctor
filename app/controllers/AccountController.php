<?php

class AccountController extends BaseController {

    public function getSignIn() 
    {

        return View::make('account.signin');
    }

    public function postSignIn() 
    {

        $validator = Validator::make(Input::all(), array(
                    'email' => 'required|email',
                    'password' => 'required'
        ));

        if ($validator->fails()) 
        {
            return Redirect::route('account-sign-in')
                            ->withErrors($validator)
                            ->withInput();
        } 
        else 
        {
            $remember = (Input::has('remember')) ? true : false;

            $auth = Auth::attempt(array(
                        'email' => Input::get('email'),
                        'password' => Input::get('password'),
                        'active' => 1
                         ), $remember);
			
			
            if ($auth) 
            {
            	$user = Auth::user();            	
            	//redirect to intended page
            	if( strtolower($user->user_type) == '1') // 1 = patient
            	{
            		return Redirect::intended('/patient/ask');
            	}
            	elseif( strtolower($user->user_type) == '2') // 2 = doctor
            	{
            		return Redirect::intended('/doctor');
            	}
            	else 
            	{
            		return Redirect::intended('/');
            	}          
                
            } 
            else 
            {
                return Redirect::route('account-sign-in')->with('global', 'Email/Password worng, or account not activated .');
            }
            
            
        }
        return Redirect::route('account-sign-in')->with('global', 'There was a problem signing you in. Have you activated ?');
    }

    public function getSignOut() 
    {

        Auth::logout();
        return Redirect::route('home');
    }

    public function getCreate() 
    {		
		$data['day'] = $this->buildDayDropdown();
		$data['month'] = $this->buildMonthDropdown();
		$data['year']  = $this->buildYearDropdown();
		
        return View::make('account.create', $data);
    }

    public function postCreate() 
    {

        $validator = Validator::make(Input::all(), array(
                    'email' => 'required|max:50|email|unique:users',
                    'username' => 'required|max:20|min:3',
                    'password' => 'required|min:6',
                    'password_again' => 'required|same:password',
        			'day' => 'required',
        			'month' => 'required',
        			'year' => 'required',
        		
        ));
        $niceNames = array(
        		'username' => 'Your Name'
        );
        $validator->setAttributeNames($niceNames);

        if ($validator->fails()) 
        {
            return Redirect::route('account-create')->withErrors($validator)->withInput();
        } 
        else 
        {
            // create account

            $email = Input::get('email');
            $username = Input::get('username');
            $password = Input::get('password');

            // Activation Code
            $code = str_random(60);

            $user = User::create(array(
                        'email' => trim($email),
                        'username' => $username,
                        'password' => Hash::make($password),
            			'user_type' => 2, // 2 = Patient 
                        'code' => $code,
                        'active' => 0
            			)
            );

            if ($user) 
            {
                //Send Email
                Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function($message) use ($user) {

                    $message->to($user->email, $user->username)->subject('Activate your account');
                });

                return Redirect::route('home')
                                ->with('global', 'Your account has been created! We have sent you an email to activate your account.');
            }
        }
    }

    public function getActivate($code) 
    {

        $user = User::where('code', '=', $code)->where('active', '=', 0);

        if ($user->count()) {
            $user = $user->first();

            //update to active state
            $user->active = 1;
            $user->code = '';

            if ($user->save()) {
                return Redirect::route('home')
                                ->with('global', 'Activated! You can now sign in!');
            }
        }

        return Redirect::route('home')
                        ->with('global', 'We could not activate your account, try again later');
    }

    public function getChangePassword() 
    {
    	if(Auth::user()->user_type == '1') // 1 = patient
    	{
        	return View::make('patient.password');
    	}
    	elseif (Auth::user()->user_type == '2') // 2 = doctor 
    	{
    		return View::make('doctor.password');
    	}
    }

    public function postChangePassword() 
    {

        $validator = Validator::make(Input::all(), array(
                    'old_password' => 'required',
                    'password' => 'required|min:6',
                    'password_again' => 'required|same:password'
        ));

        if ($validator->fails()) 
        {
            return Redirect::route('account-change-password')->withErrors($validator);
        } 
        else 
        {

            $user = User::find(Auth::user()->id);
            $old_password = Input::get('old_password');
            $password = Input::get('password');

            if (Hash::check($old_password, $user->getAuthPassword())) 
            {
                $user->password = Hash::make($password);

                if ($user->save()) 
                {
                    return Redirect::route('account-change-password')
                    ->with(array('type'=>'success', 'global'=>'Your password has been changed'));
                }
            } 
            else 
            {
                return Redirect::route('account-change-password')
                		->with(array('type'=>'danger', 'global'=>'Your old password is incorrect.'));
            }
        }

        return Redirect::route('account-change-password')
        				->with(array('type'=>'danger', 'global'=>'Your password could not be changed.'));
    }
    
    public function buildYearDropdown()
    {
    	$years = range(1940, date("Y"));
    	arsort($years);
    
    	$year_list[''] = 'Year';
    
    	foreach($years as $year)
    	{
    		$year_list[$year] = $year;
    	}
    
    	return $year_list;
    }
    
    public function buildDayDropdown()
    {
    	$day[''] = 'Day';
    	for($i = 1; $i <=31; $i++)
    	{
    		$day[$i]= $i;
    	}
    	return $day;
    }
    
    public function buildMonthDropdown()
    {
    	$month = array(
		'' => 'Month',
		'1' => 'Jan',
		'2' => 'Feb',
		'3' => 'Mar',
		'4' => 'Apr',
		'5' => 'May',
		'6' => 'Jun',
		'7' => 'Jul',
		'8' => 'Aug',
		'9' => 'Sep',
		'10' => 'Oct',
		'11' => 'Nov',
		'12' => 'Dec',
	);
	return $month;
    }

}
