<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
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

        $photos = DB::table("photos")->where("user_id", $id)->delete();
        $users = DB::table("users")->where("user_id", $id)->delete();

        $table->foreign('user_id')
            ->references('user_id')->on('users')
            ->onDelete('cascade');

        $condition = true;

        if($condition) {
            $userFolder = 'uploads/' . $id;
            File::deleteDirectory($userFolder);

            $userPhoto = $users->user_photo;
            File:delete($userPhoto);
        }
        

        return redirect('admin')->with('success', 'User & related files deleted successfully.');       
    }

}
