<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\User;
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
        $topPics = Photo::all()
        ->orderBy('likesSum' , 'desc')
        ->take(3)
        ->get();
        $recentPics = Photo::all()
        ->orderBy('date' , 'desc')
        ->take(3)
        ->get();
        $topUsers = User::all()
        ->join('photos', 'users.user_id', '=', 'photos.user_id')
        ->groupBy('photos.id_user')
        ->orderBy( 'count(photos.id_photo)' , 'desc')
        ->take(3)
        ->get();
        return view('home',
            ['topPics' => $topPics],
            ['recentPics' => $recentPics],
            ['topUsers' => $topUsers]);
    }


    /*mail*/
    public function mail()
    {
        Mail::to('therichposts@gmail.com')->send(new PaymentDone());
        return 'Email was sent';
    }
}

