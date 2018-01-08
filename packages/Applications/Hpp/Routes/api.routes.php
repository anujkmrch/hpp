<?php

Route::get('/', function () {
  return response()->json(['success'=>false,'messages'=>['Invalid Request']]);
});

Route::get('/user', function () {
  return response()->json(['success'=>false,'messages'=>['Invalid Request']]);
});

Route::post('/register', function () {
  return "register";
});

Route::get('/register', function () {
  		$rules = [
            'username' => 'required|unique:users',
            'password' => 'required',
        ];

        $input = request()->only('username', 'password');
        $validator = \Validator::make($input, $rules);
        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
       
        $credentials = $input;

        $credentials['password'] = \Hash::make($credentials['password']);
        $credentials['email'] = uniqid();
        $credentials['name'] = mt_rand(1,30).mt_rand(55,100);

        $user = \Hpp\Models\User::create($credentials);
        $role = \System\Models\Role::where('slug',config('hpp.register_user_default_role','subscriber'))->first();
        $user->roles()->save($role);

        // all good so return the token
        return response()->json(['success' => true, 'message'=>'Succesfully Created']);
});

Route::post('login',function(){
	 	$rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $input = request()->only('username', 'password');
        $validator = \Validator::make($input, $rules);
        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        
        $credentials = $input;
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = \JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (\JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 200);
        }

        $user = \App\User::where('username',$input['username'])->first();

        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token,'user' => $user]]);


	$credential = request()->only(['username','password']);
	return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email to complete your registration.','request'=>$credential]);
		// return response()->json(['status'=>true,'messages'=>['username'=>'Hello','email'=>'me@su.com','role'=>'Subscriber']]);
});

Route::get('login',function(){

	 	$rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $input = request()->only('username', 'password');
        $validator = \Validator::make($input, $rules);
        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $credentials = [
            'email' => request()->email,
            'password' => request()->password,
            'is_verified' => 1
        ];
        $credentials = $input;

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = \JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (\JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 200);
        }
        
        $user = \System\Models\User::with('roles')->where('username',$input['username'])->first();
        
        $user->type = $user->roles->first();
        
        unset($user->roles);

        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token,'user' => $user ]]);
});

Route::group(['middleware'=>'jwt.auth','jwt.refresh'],function(){
	Route::post('authenticate',function(Request $request){
		return response()->json(['fingerpring'=>request()->input('fingerprint','dsdsd')]);
	});
  
  Route::get('logout', function (Request $request) {
        $rules = [
            'token' => 'required'
        ];
        $input = request()->only('token');
        $validator = \Validator::make($input, $rules);
        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        try {
            JWTAuth::invalidate(request()->get('token'));
            return response()->json(['success' => true,'messages'=>['You\'re Succefully logged out']]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    });

  Route::get('/report', function () {
    return "hello";
  });

  Route::get('/verify', function (Request $request) {

	$rules = [
        'fingerprint' => 'required',
        'up' => 'required',
	];

    $input = request()->only('fingerprint','up');
    $validator = \Validator::make($input, $rules);

    if($validator->fails()) {
       $error = $validator->messages()->toJson();
       return response()->json(['success'=> false, 'error'=> $error]);
    }

    try {
        // attempt to verify the credentials and create a token for the user
        if ($cordinator = JWTAuth::parseToken()->authenticate()) {
        	 if(!\System::can('can_mark_attendance')):
                return response()->json(['success'=>false,'messages'=>['you\'re not allowed to mark attendance']]);
            endif;
            if($user = \Hpp\Models\User::with('attendances')->where('username',$input['fingerprint'])->first()){
        		if($user->id == $cordinator->id)
        		{
        			return response()->json(['success'=>false,'messages'=>['you cannot mark self attendance']]);
        		}
		    	$attendance = new \Hpp\Models\Attendance;
		    	$attendance->user_id = $user->id;

		    	if($input['up']){
		    		$attendance->up = true;
		    	} else{
		    		$attendance->down = true;
		    	}

		    	$cordinator = \Hpp\Models\User::find($cordinator->id);
	            
	            $cordinator->markAttendance()->save($attendance);

	            return response()->json(['success' => true,'report' => false, 'messages'=>['Attendance Marked']]);
		    }
		    
            return response()->json(['success' => false,'report' => true, 'messages'=>['User not found']]);
       
            }
        } catch (\JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'messages'=>['Something went wrong']]);
        }
    });
});
?>









