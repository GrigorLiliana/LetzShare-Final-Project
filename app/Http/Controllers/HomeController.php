<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\User;

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
        $top3Pics = Photo::all()
        ->orderBy('likesSum' , 'desc')
        ->take(3)
        ->get();
        $recent3Pics = Photo::all()
        ->orderBy('date' , 'desc')
        ->take(3)
        ->get();
        $top3Users = User::all()
        ->join('photos', 'users.user_id', '=', 'photos.user_id')
        ->groupBy('photos.id_user')
        ->orderBy( 'count(photos.id_photo)' , 'desc')
        ->take(3)
        ->get();
        return view('home');
    }
}
