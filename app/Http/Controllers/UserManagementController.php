<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \Exception;
use \Log;
use DB;
use Hash;
use App\Rules\ValidRecaptcha;

class UserManagementController extends Controller
{
  public function signup(Request $request) {
		try {

      return view('signup');
		} catch (Exception $e) {
			Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);
      abort(404);
		}
	}

	
	function signupHanlde(Request $request) {
		try {
			$validator = Validator::make($request->all(),[
				"first_name"		=>	"required|min:2",
				"last_name"		=>	"required|min:1",
				"email"		=>	"required|email:rfc|unique:users,email",
				"telephone"		=>	"required|unique:users,phone",
				"password"	=>	"required|confirmed",
				 //'g-recaptcha-response' => [new ValidRecaptcha]
			]);

			if ($validator->fails()) {
        throw new Exception(implode(",",$validator->messages()->all()));
      } 

      $rt = md5(rand(1, 10000) . $request->email . now());
			
			DB::table('users')->insert([
				"first_name"	=>	$request->first_name,
				"last_name"	=>	$request->last_name,
        "email"			=>	$request->email,
        "agentname" => $request->agentname,
        "phone"   => $request->telephone,
				"password"		=>	Hash::make($request->password),
        "remember_token" => $rt,
				'type'			=>	'user',
				"created_at"	=>	date("Y-m-d H:i:s"),
				"updated_at"	=>	date("Y-m-d H:i:s")
			]);
		 	
      
      app('App\Http\Controllers\mailController')->sendVerifyEmail($request->email, $rt);
      $msg = ["success" => true, "msg" =>	"Account created successfully, please confirm your email and login now."];
		} catch (Exception $e) {
			Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);

     
      $msg = ["success" => false, "msg" =>	"Error: ". $e->getMessage()];
		}
		
    
    return view('message', compact('msg'));
	}

  public function login(Request $request) {
		try {

      return view('login');
		} catch (Exception $e) {
			Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);
      abort(404);
		}
	}


	public function loginHandle(Request $request) {
		try {

				$request->session()->flash('form', 'login');
		
				$validator = Validator::make($request->all(),[
					"email"		=>	"required|",
					"password"	=>	"required"
				]);

				if ($validator->fails()) {
          throw new Exception($validator->getMessageBag()->toArray());
				} 
		
				$credentials = $request->only('email', 'password');

				if (Auth::attempt($credentials)) {
					$useru = User::find(Auth::id());

          if ($useru->email_verified_at == null) {
            Auth::logout();
            throw new Exception("Kindly verify your email first to login");
          }

        if ($useru->status == 'ban') {
            Auth::logout();
            throw new Exception("Your account had been banned, kindly contact us.");
          }


					$useru->last_login =now();
					$useru->save();
				} else {
					throw new Exception("Invalid username/password");
				}
        return redirect('/');
		} catch (Exception $e) {
			Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);

      return back()->withErrors($e->getMessage())
                        ->withInput();
		}

	}

	public function logout() {
		try {
			Auth::logout();
			$msg = ["success" => true, 'msg' => "Logged out successfully."];
		} catch (Exception $e) {
			Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);

			$msg = ["success" => false, "msg"	=>	$e->getMessage()];
		}

    return view('message', compact('msg'));
	}
  public function verifyEmail($hash) {
    try {
        $useru = User::where('remember_token', $hash)->first();

        if (!$useru) {
            throw new Exception("Invalid verify link");
        }

        $useru->email_verified_at = now();
        $useru->remember_token = md5(now().$useru->email);
        $useru->status = 'active';
        $useru->save();

        $msg = ["success" => true, "msg"	=> "Email verified, please proceed to login"];
      } catch (Exception $e) {
          Log::info([
            "Error"	=>	$e->getMessage(),
            "File"	=>	$e->getFile(),
            "Line"	=>	$e->getLine()
          ]);

          $msg = ["success" => false, "msg"	=>	$e->getMessage()];
        }
      
      return view('message', compact('msg'));
  }

	function reset(Request $request) {
    try {
      $validator = Validator::make($request->all(),[
        "email"		=>	"required|email:rfc|exists:users,email",
      ]);

      if ($validator->fails()) {
        throw new Exception(implode(",",$validator->messages()->all()));
      }

      $new_password =  strtoupper(substr(preg_replace("/[^a-zA-Z0-9]+/", "",
          base64_encode(random_bytes(16))), 0, 7)); 
    
      DB::table('users')->
        where('email', $request->email)->update([
          "password"		=> Hash::make($new_password),
          "updated_at"	=> now()
        ]);
       app('App\Http\Controllers\mailController')->sendResetPassword($request->email, $new_password);

       $msg =  ["success" => true,	"msg"	=>	"Password reset successfully. Please check your inbox."];

      } catch (Exception $e) {
          Log::info([
            "Error"	=>	$e->getMessage(),
            "File"	=>	$e->getFile(),
            "Line"	=>	$e->getLine()
          ]);

          $msg = ["success" => false, "msg"	=>	$e->getMessage()];
        }
 
       return view('message', compact('msg'));
	}

  public function changePassword() {
    return view('change_password');
  }

  public function changePasswordHandle(Request $request) {
    try {
    
      $validator = Validator::make($request->all(),[
        "password"	=>	"required|min:5|confirmed",
				"oldpassword"	=>	"required",
			]);

			if ($validator->fails()) {
        throw new Exception(implode(",",$validator->messages()->all()));
      } 

         #Match The Old Password
        if(!Hash::check($request->oldpassword, auth()->user()->password)){
        throw new Exception("Invalid old password");
        }
      
      $user_id = Auth::id();
      $user = User::find($user_id);
      $user->password = Hash::make($request->password);
      $user->save();
      $msg = ["success" => true, "msg"	=> "Password changed successfully"];

    } catch (Exception $e) {
      Log::info([
        "Error"	=>	$e->getMessage(),
        "File"	=>	$e->getFile(),
        "Line"	=>	$e->getLine()
      ]);

      $msg = ["success" => false, "msg"	=>	$e->getMessage()];
    }
    
    return view('message', compact('msg'));
  }


		public function userDatatable(Request $request) {
		
		$data = DB::table('users')->get();

		return Datatables::of($data)->
			addIndexColumn()->
			addColumn('name', function ($c) {
				return "$c->first_name $c->last_name";
			})->

			addColumn('email', function ($c) {
				return $c->email;
			})->

			addColumn('is_verified', function ($c) {
        return !empty($c->email_verified_at) ?  '<span style="font-size: 20px; color:green;"><i class="fa fa-check"></i></span>':'<span style="font-size: 20px; color:red;" ><i class="fa fa-times"></i></span>';

			})->

			addColumn('status', function ($c) {
				return ucfirst($c->status ?? '');
			})->

			addColumn('ban', function ($c) {
				$id = $c->id;

        if ($c->status == 'ban')
          return '';

				return <<<EOD
			<span onclick="ban($id)" class="ban_btn"><i class="fa fa-ban"></i></span>
EOD;
			})->

			escapeColumns([])->make(true);
	}

	function viewModalUupdate() {
		$user = DB::table('users')->find(request()->admin_id);
	
		if (empty($user))
			abort(400);

		return view('components.admin_update_modal',compact('user'));	
	}

  public function banUser(Request $request) {
		try {
      if (Auth::User()->type != 'admin')
        throw new Exception("You don't have the privilege to perform action");
 
      $validator = Validator::make($request->all(),[
				"user_id"	=>	"required",
			]);

			if ($validator->fails()) {
        throw new Exception(implode(",",$validator->messages()->all()));
      } 

      $user = User::find($request->user_id);
      if (!$user)
        throw new Exception("Invalid user id");

      $user->status = "ban";
      $user->save();

      return response()->json(['status'=>'ok']);
		} catch (Exception $e) {
			Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);
      abort(404);
		}
	}

}
