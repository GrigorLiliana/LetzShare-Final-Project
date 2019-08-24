<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;

use App\User;
use App\Photo;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $users = User::all();

        return view('admin', [
            'users' => $users,
        ]);
    }

    public function showUser($id){

        $photos = Photo::where('user_id', '=', $id)->get();
        $user = User::find($id);

        return view('admin-delete-user', [
            'photos' => $photos,
            'user' => $user
        ]);        
    }

    public function deleteUser($id){

        $users = User::where('user_id', '=', $id)->get();

        $userDeleted = DB::table("users")->where("user_id", $id)->delete();
        //$photosDeleted = DB::table("photos")->where("user_id", $id)->delete();

        if($userDeleted) {
            $userFolder = 'uploads/' . $id;
            File::deleteDirectory($userFolder);

            $userPhoto = $users->user_photo;
            File:delete($userPhoto);
        }
        

        return redirect('admin')->with('success', 'User & related files deleted successfully.');       
    }

}
