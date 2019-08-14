<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PaymentDone;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    /*mail*/
    public function mail()
    {
        Mail::to('therichposts@gmail.com')->send(new PaymentDone());
        return 'Email was sent';
    }
}
