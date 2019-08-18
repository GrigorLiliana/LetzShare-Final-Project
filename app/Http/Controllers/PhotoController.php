<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Location;
use App\Category;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = DB::table('photos')
            ->join('users', 'users.user_id', '=', 'photos.user_id')
            ->join('locations', 'locations.locality_id', '=', 'photos.locality_id')
            ->select('photos.*', 'users.name', 'locality_name')
            ->get();

        return view('gallery', ['photos' => $photos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();

        return view('uploadphoto', ['categories'=>$categories, 'locations'=>$locations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $userId = Auth::user()->user_id;
        $imageName = $userId.'.'.request()->image->getClientOriginalExtension();


        if (!file_exists("uploads/$userId")) {
            mkdir("uploads/$userId", 0755, true);
        }

        if(file_exists("uploads/$userId/$imageName")){
        $i=0;
        do {
            $imageName = $userId . "_" . $i .'.'.request()->image->getClientOriginalExtension();;
        } while(file_exists("uploads/$userId/$imageName"));
        }

        request()->image->move(public_path("uploads/$userId"), $imageName);



        return back()

            ->with('success','You have successfully upload image.')

            ->with('image',$imageName);


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
