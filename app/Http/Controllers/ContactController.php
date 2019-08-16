<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ContactController extends Controller
{
    // https://www.youtube.com/watch?v=rn0BHdqrock
    function index()
    {
        return view('contact');
    }

    function sendEmail(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|max:500'
        ]);

        $data = array(
            'fullname' => $request->fullname,
            'message' => $request->message
        );

        Mail::to($request->email)->send(new SendMail($data));

        return back()->with('success', 'Thanks for contacting us!');
    }
}
