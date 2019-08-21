<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use EloquenteBuilder;
use Auth;
use App\Location;
use App\Category;
use App\Photo;

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
            ->join('categories', 'categories.category_id', '=', 'photos.category_id')
            ->select('photos.*', 'users.name', 'users.user_photo', 'locations.locality_name', 'categories.category_icon', 'categories.category_name')
            ->orderBy('created_at', 'desc')
            ->get();

        //$photo->name = $request->name;

        return view('gallery', ['photos' => $photos]);
    }

    public function filters(Request $request)
    {
        $photos = DB::table('photos')
            ->join('users', 'users.user_id', '=', 'photos.user_id')
            ->join('locations', 'locations.locality_id', '=', 'photos.locality_id')
            ->join('categories', 'categories.category_id', '=', 'photos.category_id')
            ->select('photos.*', 'users.name', 'users.user_photo', 'locations.locality_name', 'categories.category_icon', 'categories.category_name')
            ->where(
                'users.user_id',
                '=',
                Input::get('users')
                    or 'locations.locality_id',
                '=',
                Input::get('locality')
                    or 'categories.category_id',
                '=',
                Input::get('category')
            )
            ->orderBy('created_at', 'desc')
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

        return view('uploadphoto', ['categories' => $categories, 'locations' => $locations]);
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
        $imageName = $userId . '_0.' . request()->image->getClientOriginalExtension();


        if (!file_exists("uploads/$userId")) {
            mkdir("uploads/$userId", 0755, true);
        }

        if (file_exists("uploads/$userId/$imageName")) {
            $i = 0;
            do {
                $imageName = $userId . "_" . $i . '.' . request()->image->getClientOriginalExtension();
                $i++;
            } while (file_exists("uploads/$userId/$imageName"));
        }

        request()->image->move(public_path("uploads/$userId"), $imageName);

        $validatedData = \Validator::make($request->all(), [
            'title' => 'required|min:4|max:20|',
            'description' => 'required|min:4',
            'locality' => 'required',
            'category' => 'required'
        ]);

        $photo = new Photo();
        $photo->image_title = $request->title;
        $photo->image_URL = "uploads/$userId/$imageName";
        $photo->image_description = $request->description;
        $photo->category_id = Input::get('category');
        $photo->locality_id = Input::get('locality');
        $photo->user_id = $userId;
        $photo->likes_sum = 0;
        $photo->save();

        return redirect('useraccount');
    }

    public function postLikePost(Request $request) {
        $photo_id = $request['photoId'];
        $is_like = $request['isLiked'] === 'true';
        $update = false;
        $photo = Photo::find($photo_id);
        if (!$photo) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('photo_id' , $photo_id)->first();
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
