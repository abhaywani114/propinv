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

// ##########################################################
// ##########################################################
// ##########################################################
// ##########################################################
// ##########################################################

		public function addNewTeacher(Request $request) {
		try {

			if (empty($request->admin_id)) {
				$validator = Validator::make($request->all(),[
					"name"				=>	"required|min:5",
					"email"				=>	"required|email:rfc|unique:users,email",
					"password"			=>	"required|confirmed",
					"status"			=>	"required"
				]);
			} else {
				$user = DB::table('users')->find(request()->admin_id);
				$validator = Validator::make($request->all(),[
					"name"				=>	"required|min:5",
					"email"				=>	($user->email != $request->email) ? "required|email:rfc|unique:users,email":"required",
					"password"			=>	"confirmed",
					"status"			=>	"required"
				]);
			}


			if ($validator->fails()) {
				return response()->json(array(
					'success' => false,
					'errors' => $validator->getMessageBag()->toArray()
				), 400);
			} 

			$array = [];
			$array['name']			= $request->name;
			$array['email']			= $request->email;
			
			if (!empty($request->password))
				$array['password']		= Hash::make($request->password);

			$array['type']			= 'admin';
			$array['status']		= $request->status;
			$array['updated_at']	= now();

			if (empty($request->admin_id))
				$array['created_at']	= now();

			if (empty($request->admin_id))
				DB::table('users')->insert($array);
			else
				DB::table('users')->where('id', $request->admin_id)->update($array);

			if (empty($request->teacher_id))
				$return = ["success" => true,"msg"	=> "Admin added"];
			else
				$return = ["success" => true,"msg"	=> "Admin update"];

		} catch (Exception $e) {
			Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);

			$return = ["success" => false,"error"	=>	$e->getMessage()];
		}

		return $return ?? '';

	}

		public function updateProfile(Request $request) {
			
			try {

				$validator = Validator::make($request->all(),[
					"password"			=>	"confirmed",
				]);
		
				if (!empty($request->password))
					$array['password']		= Hash::make($request->password);

				$array['updated_at']	= now();

				DB::table('users')->where('id', Auth::User()->id)->update($array);

				$return = ["success" => true,"msg"	=> "Profile update"];	
				
			} catch (Exception $e) {
			Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);

			$return = ["success" => false,"error"	=>	$e->getMessage()];
			}

			return $return ?? '';
		}

		public function datatableMain(Request $request) {
		
		$data = DB::table('users')->where('type','admin')->get();

		return Datatables::of($data)->
			addIndexColumn()->
			addColumn('name', function ($c) {
				return $c->name;
			})->

			addColumn('email', function ($c) {
				return $c->email;
			})->

			addColumn('last_date', function ($c) {
				return !empty($c->last_login) ? date("d-M-Y", strtotime($c->last_login)):'-';
			})->

			addColumn('status', function ($c) {
				return ucfirst($c->status);
			})->

			addColumn('edit', function ($c) {
				$id = $c->id;
				return <<<EOD
			<span onclick="updateAdmin($id)" class="edit_btn"><i class="fa fa-edit"></i></span>
EOD;
			})->

			addColumn('delete', function ($c) {
				return <<<EOD
				<span onclick="delete_admin($c->id)" class="edit_btn text-danger"><i class="fa fa-trash"></i></span>
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

	public function deleteAdmin(Request $request) {
		DB::table('users')->where('id', request()->course_id)->delete();
		return ["success" => true];
	}

}
