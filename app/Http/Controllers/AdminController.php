<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

    public function deleteUser($id) {

        $user = User::find($id);
        $userFolder = 'uploads/' . $id;
        $userPhoto = $user->user_photo;
        $userPhotoDefault = strstr($user->user_photo, 'default_user');

        $userDeleted = DB::table("users")->where("user_id", $id)->delete();


        if($userDeleted) {
            if(File::exists($userFolder)) 
                File::deleteDirectory($userFolder);
            
            if(File::exists($userPhoto) && $userPhotoDefault == false)   
                File::delete($userPhoto);
        } else {
            return redirect('admin')->with([
                'status' => 'ERROR: User & related files.',
                'class' => 'alert alert-danger alert-dismissible fade show',
            ]);
        }
        
        return redirect('admin')->with([
            'status' => 'SUCCESS: User & related files deleted successfully.',
            'class' => 'alert alert-success alert-dismissible fade show',
        ]);       
    }

}
