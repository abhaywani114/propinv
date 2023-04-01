<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;
use DB;
use \Auth;

class mailController extends Controller
{
	public function sendContactForm(Request $request) {
		
    try {
			$validator = Validator::make($request->all(),[
                "first_name"		=> 'required',
                "last_name"		=> 'required',
                "email" 	=> ['required','email'],
                "message" 	=> 'required'
			]);

			if ($validator->fails()) {
				return response()->json(array(
					'success' => false,
					'errors' => $validator->getMessageBag()->toArray()
				), 400);
			}


		    $data = $request->validate([
                "first_name" => ['required'],
                "last_name"	=>	 ['required'],
                "phone"	=>	 ['required'],
                "email" => ['required','email'],
                "message" => ['required'],
        	]);
			 
			Mail::send('email.contact_support',compact('data') , function($message) use ($data) {
			   $sub = $data['subject'] ?? '';
			   $message->from('support@frcsmockexam.com', 'Support' );
			   $message->to(env('MAIL_FROM_ADDRESS'))->subject("$sub | Contact Request");
			});
    } catch (Exception $e) {
      throw $e;
    }
 

		return ['status' =>	true];
	}

	public function sendResetPassword($email, $password) {
		Mail::send('email.reset_password', compact('email', 'password'), function($message) use ($email) {
           $message->from('support@frcsmockexam.com');
           $message->to($email)->
           subject("Reset Password");
       });	
	}
  
  public function sendVerifyEmail($email, $hash) {
		Mail::send('email.verify_email', compact('email', 'hash'), function($message) use ($email) {
           $message->from('support@frcsmockexam.com');
           $message->to($email)->
           subject("Verify Email");
       });	
	}
  public function sendForm1($request_type, $html, $uploadedFile) {
		Mail::send('email.form1_email', compact('request_type', 'html', 'uploadedFile'), function($message) use ($request_type) {
           $message->from('support@frcsmockexam.com');
           $message->to('abhaywani114@gmail.com')->
           subject($request_type);
       });	
	}
}
