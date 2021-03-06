<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{

    public function index(){
        return view('frontend.contact');
    }

    public function contactlist(){
        $data = [];
        $data['contacts'] = Contact::all();
        return view('backend.admin.contact', $data);
    }

    public function store(Request $request){

        $this->validate($request, [

            'mail' => 'required|email',
            'phn_number' => 'required|max:11',
            'message' => 'required'
        ]);


       $contacts = new Contact();
       $contacts->username = $request->username;
       $contacts->mail     = $request->mail;
       $contacts->phn_number = $request->phn_number;
       $contacts->message  = $request->message;
       $contacts->save();

       session()->flash('success', 'Contact Message Sent Successfully!');

       return redirect(route('contactFrontEnd'));
    }

    public function show(){

        $data = [];
        $data['contacts'] = Contact::all();

        return redirect(route('contactbackend'), $data);
    }

    public function deleteContact($id){

        Contact::find($id)->delete();
        session()->flash('success', 'Contact Message Delete Successfully!');
        return redirect(route('contactbackend'));
    }
}
