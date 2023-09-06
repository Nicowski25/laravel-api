<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\NewContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();
        //validate the request fields
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        //check if validation fails and return the error message
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        };
        
        //save into DB
        $newContact = new Contact();
        $newContact->fill($data);
        $newContact->save();

        //send the email
        Mail::to('nicola.faedo0610@gmail.com')->send(new NewContact($newContact));

        return response()->json([
            "success" => true,
        ]);
    }
}
