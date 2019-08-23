<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\User;
use File;
use Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $userPhotos = DB::table('users')
            ->leftjoin('photos', 'users.user_id', '=', 'photos.user_id')
            ->leftjoin('locations', 'locations.locality_id', '=', 'photos.locality_id')
            ->leftjoin('categories', 'categories.category_id', '=', 'photos.category_id')
            ->where('users.user_id', $id)
            ->select('photos.*', 'photos.created_at as photodate', 'users.*', 'locations.*', 'categories.*')
            ->orderby('photodate', 'desc')
            ->simplePaginate(12);


        return view('userprofile', ['userPhotos' => $userPhotos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validatedData = \Validator::make($request->all(), [
            'name' => 'required|min:4|max:20|',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->save();
            return response()->json(['success' => 'successiful entered', 'name' => $user->name]);
        }
    }

    public function description(Request $request, $id)
    {
        $validatedData = \Validator::make($request->all(), [
            'description' => 'required|min:4|max:200|',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        } else {
            $user = User::find($id);
            $user->user_description = $request->description;
            $user->save();
            return response()->json(['success' => 'successiful entered', 'description' => $user->user_description]);
        }
    }
    public function changePhoto(Request $request, $id)
    {
        $validatedData = \Validator::make($request->all(),[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validatedData->fails()){

            $errors = $validatedData->errors()->all();

            $string='';
            foreach ($errors as $value){
               $string .=  $value .' ';
            }
            return redirect('userprofile/' . $id)->with('error', "$string");

        }else{

            $user = User::find($id);
            $imageName ="uploads/users/". $id . '.' . request()->image->getClientOriginalExtension();

            $destinationPath = $user->user_photo;
            File::delete($destinationPath);
            request()->image->move(public_path("uploads/users"), $imageName);
            $user->user_photo = $imageName;
            $user->save();
            return redirect('userprofile/' . $id);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
