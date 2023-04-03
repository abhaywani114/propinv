<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandleRequestsController extends Controller
{
    //
  public function form1(Request $request) {
    try {
      $fields = [
        "agentname" => "Agent/Business Name", 
        "firstname" => "First Name",
        "lastname" => "Last Name",
        "agentemail" => "Agent Email",
        "telephone" => "Agent Telephone",
        "propertytype" => "Type of Property",
        "propertysize" => "Property Size",
        "propertyfurnishing" => "Furnishing",
        "firstline" => "Street Name and House Number",
        "area" => "Area",
        "towncity" => "Town/City",
        "postcode" => "Postal Code",
        "tt1name" => "Tenant One Name",
        "tt1phone" => "Tenant One Phone Number",
        "tt1email" => "Tenant One Email",
        "tt2name" => "Tenant Two Name",
        "tt2phone" => "Tenant Two Phone Number",
        "tt2email" => "Tenant Two Email",
        "tenancytype" => "Type of tenancy is to be assigned",
        "tend_datepicker" => "Tenancy start date",
        "managementcategory" => "Management Category",
        "datepicker" => "Date",
        "keycollection" => "Key Collection Location",
        "keyreturn" => "Key Return Location",
        "furtherinfo" => "Further Info"
      ];

      $request_type = implode(',',$request->question_1) ?? "";
      $html = $this->renderHtml($fields, $request);
      $uploadedFile = $this->saveFile("fileupload");
      app('App\Http\Controllers\mailController')->sendForm1($request_type, $html, $uploadedFile);
      $msg = ["success" => true, "msg" =>	"Your response has been recorded, we will contact you shortly"];
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

  public function contactForm(Request $request) {
    try {
      app('App\Http\Controllers\mailController')->sendContactForm($request);
      $msg = ["success" => true, "msg" =>	"Your response has been recorded, we will contact you shortly"];
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


  private function renderHtml($fields, $request) {
    $html = '<ul>';

    foreach($fields as $key => $value) {
      $html .= "<li>$value: <strong>".$request->$key."</strong></li>";
    }
    $html .= '</ul>';

    return $html;
  }

  public function saveFile($fieldName) {
    // Check if file was uploaded
    if(request()->hasFile($fieldName)) {

        // Get the file from the request
        $file = request()->file($fieldName);

        // Get the file extension
        $extension = $file->getClientOriginalExtension();

        // Check if the file type is allowed
        if(in_array($extension, ['gif', 'jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'])) {

            // Generate a unique name for the file
            $fileName = time().'-'.$file->getClientOriginalName();

            // Save the file to the storage folder
            $path = $file->storeAs('public/files', $fileName);

            // Return the static URL for the file
            return asset(str_replace('public', 'storage', $path));
        }

        // Return null if the file type is not allowed
        return null;
    }

    // Return null if no file was uploaded
    return null;
    }

}
