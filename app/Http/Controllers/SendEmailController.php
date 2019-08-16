<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    // https://www.youtube.com/watch?v=rn0BHdqrock
    function index()
    {
        return view('contact');
    }

    function send(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|max:500'
        ]);
    }
}
