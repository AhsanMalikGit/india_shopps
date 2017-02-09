<?php namespace indiashopps\Http\Controllers;

use DB;
use indiashopps\Http\Controllers\Controller;
use indiashopps\Helpers\helper;
use indiashopps\AndUser;
use Illuminate\Http\Request;
use Illuminate\Hashing;
use Validator;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{

	public function __construct()
	{
		// parent::__construct();
	}

	/**
	* User Registration Controller with Server Side Validation
	*
	* @var \Illuminate\Http\Request
	*/
	public function register( Request $request )
	{
		if (Auth::check())
		{
			//Redirect If already Loggedn in, with Success Message... 
			return redirect("myaccount")->with("success", array( "Already Logged in.. !" ) );
		}

		if( $request->isMethod('post') )
		{
			// POST Form Validation
			$validator = Validator::make($request->all(), [
	            'email' 	=> 'required|email|unique:and_user',
	            'name'  	=> 'required',
	            'password'  => 'required|min:6',
	            'gender'  	=> 'required',
	        ]);

			if ($validator->fails())
			{
				//If Validation Fails
				$messages = $validator->messages();
				return redirect("user/register")->with("errors",$messages);
			}

			// ELSE create a new User
			$data['email']		= $request->get('email');
			$data['gender'] 	= $request->get('gender');
			$data['interests'] 	= json_encode( $request->get('interests') );
			$data['password'] 	= \Hash::make( $request->get('password') );
			$data['name'] 		= $request->get('name');
			$data['join_date'] 	= date("Y-m-d h:i:s");

			$user = new AndUser( $data );
			$user->save();
			
			//Login the user by Default once user Registers.. 
			if( $user->id )
			{
				Auth::loginUsingId( $user->id );

				return redirect('/');
			}
		}

		//If any Error Message is set.. 
		if( session()->has('errors') )
		{
			$data['errors'] = session("errors");
		}
		
		// Get Top level Categories to show as suggestion to the user.. 
		$data['cats'] 		= helper::get_categories();
		
		return view( 'v1.auth.register', $data );
	}

	/**
	* User Account page, and saving the User information, once user updates.. 
	*
	* @var \Illuminate\Http\Request
	*/
	public function myaccount( Request $request )
	{
		if (!Auth::check())
		{
			return redirect("/user/login");
		}
		else
		{
			// User save the profile information.
			if( $request->isMethod('post') )
			{
				//POST form validation..
				$validator = Validator::make($request->all(), [
		            'name'  	=> 'required',
		            'password'  => 'min:6',
		            'gender'  	=> 'required',
		        ]);

				if ($validator->fails())
				{
					//Validation fails, redirect with Error.. 
					$messages = $validator->messages(); // Validation Error Message. 
					return redirect("myaccount")->with("errors",$messages);
				}

				$user = AndUser::find( Auth::user()->id ); // Get User information by USER ID..

				$user->gender 		= $request->get('gender');
				$user->interests 	= json_encode( $request->get('interests') );
				$user->name 		= $request->get('name');

				if( !empty($request->get('password')) )
				{
					$user->password 	= \Hash::make( $request->get('password') );
					$message[] = "Password Changed.. !!";
				}

				$message[] = "Profile Updated !!";
				$user->save(); // Save USER information.. 

				return redirect('myaccount')->with("success", $message );
			}
		}

		if( session()->has('success') )
		{
			$data['success'] = session("success");
		}

		$data['cats'] 		= helper::get_categories();
		$data['user'] = Auth::user();

		return view( 'v1.auth.myaccount', $data );
	}

	/**
	* USER Login Controllers.. 
	*
	* @var \Illuminate\Http\Request
	*/

	public function login( Request $request )
	{
		if (Auth::check())
		{
			//Redirect to Myaccount page, if already Logged in.. 
			return redirect("myaccount")->with("success", array( "Already Logged in.. !" ) );
		}
		
		if( $request->isMethod('post') )
		{
			$validator = Validator::make($request->all(), [
	            'email' 	=> 'required|email',
	            'password'  => 'required',
	        ]);

			// Validation Failed..
			if ($validator->fails())
			{
				$messages = $validator->messages();
				return redirect("login")->with("errors",$messages);
			}
			elseif(Auth::attempt(['email' => $request->get('email'),'password' => $request->get('password')], $request->has('remember')))
			{
			    // Valid Login attempt.....
			    return redirect("/");
			}
			else
			{
				//Invalid Login attempt.. 
				$errors = new MessageBag(['password' => ['Email and/or password invalid.']]); 
				return redirect()->back()->withInput()->withErrors($errors);
			}
		}

		$data['cats'] 		= helper::get_categories();
		$data['registered']	= false;

		if( session()->has('success') )
		{
			$data['success'] = session("success");
		}

		return view( 'v1.auth.login', $data );
	}

	/**
	* User @ResetPassword..
	*
	* @var \Illuminate\Http\Request
	*/
	public function resetPassword( Request $request )
	{
		
		if (Auth::check())
		{
			//redirect if already logged in.. 
			return redirect("myaccount")->with("success", array( "Already Logged in.. !" ) );
		}

		if( $request->isMethod('post') )
		{
			if( $request->has('form_action') && $request->get("form_action") == "change_password" )
			{
				// Validation Rule.
				$rules = array(
				    'password' 	=> 'required|min:6',
				    'cpassword' => 'required|same:password|min:6',
				);

				// Get USER info, by the TOKEN value.. 

				$user = AndUser::where( 'remember_token', '=', $request->get('rtoken') )->first();

				// Validation Custom Message.
				$messages = [
				    'same'    => 'The Password and Confirm Password must match.',
				];

				$validator = Validator::make($request->all(), $rules, $messages );

				if ($validator->fails())
				{
					$messages = $validator->messages();
					return redirect("user/resetPassword?token=".$user->remember_token)->with("errors",$messages);
				}
				else
				{
					//Reset Password.. 
					$password = \Hash::make( $request->password );

					$user->active = 1;
					$user->password = $password;
					$user->save();

					return redirect("/user/login")->with("success", array( "Password Changed...!!" ) );
				}
			}
			else
			{
				// Sending the LINK to reset the password
				// Validation Rule for EMAIL
				$validator = Validator::make($request->all(), [
		            'email' 	=> 'required|email',
		        ]);

				if ($validator->fails())
				{
					$messages = $validator->messages();
					return redirect("user/resetPassword")->with("errors",$messages);
				}
				elseif( $user = $this->userExists( $request->get('email') ) )
				{
				    // IF user exists, deactivate the user and send the password to the registered EMAIL ID
				    $user->active = 0;
				    $user->save();

				    \Mail::send('v1.emails.reset', [ 'user' => $user ], function ($m) use ($request) {
			            
			            $m->from('pricewatch@indiashopps.com', 'Indiashopps');
			            $m->to( $request->get('email') )->subject('Password Reset - Indiashopps');
			        });

				    return redirect("/user/login")->with("success", array( "Reset link sent to the registered Email ID" ) );
				}
				else
				{
					$errors = new MessageBag(['password' => ['Email ID doesnt exist in our system...']]); 
					return redirect()->back()->withInput()->withErrors($errors);
				}
			}
		}

		if( $request->has('token') )
		{
			$user = AndUser::where( 'remember_token', '=', $request->get('token') )->where('active',0)->first();

			if( is_null( $user ) )
			{
				//Sending CUSTOMER error message.. 
				$errors = new MessageBag(['token' => ['Invalid Token or Expired.']]);

				return redirect("user/resetPassword")->with("errors",$errors);
			}
			else
			{
				$data['user'] = $user;
				$data['title'] = "Reset Password..";
			}
		}

		$data['registered']	= false;
		return view( 'v1.auth.reset_password', $data );
	}

	/**
	* Check if the USER exists..  
	*
	* @var Email ID..
	*/
	protected function userExists( $email )
	{
		$user = AndUser::where( 'email', '=', $email )->first();

		if( is_null( $user ))
		{
			return false;
		}
		else
		{
			return $user;
		}
	}

	/**
	* User Account Logout .
	*
	* @var \Illuminate\Http\Request
	*/
	public function logout( Request $request )
	{
		Auth::logout();
		
		return redirect("/");
		
	}
}