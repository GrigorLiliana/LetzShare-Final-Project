<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Location;
use App\Category;
use App\Photo;
use App\User;
use App\Like;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $photos = DB::table('photos')
            ->join('users', 'users.user_id', '=', 'photos.user_id')
            ->join('locations', 'locations.locality_id', '=', 'photos.locality_id')
            ->join('categories', 'categories.category_id', '=', 'photos.category_id')
            ->select('photos.*', 'users.name', 'users.user_photo', 'locations.locality_name', 'categories.category_icon', 'categories.category_name')
            /* ->where('users.user_id', '=', $request->users)
            ->whereNull('locations.locality_id', '=', $request->locality) */
            ->orderBy('created_at', 'desc')
            ->distinct()
            ->get();

        $users = User::all()->where('users.user_id', '=', $request->users);

        $locations = Location::all();

        $categories = Category::all();

        $likes = Photo::orderBy('likes_sum', 'desc')
            ->get();

        return view('gallery', [
            'photos' => $photos,
            'users' => $users,
            'locations' => $locations,
            'categories' => $categories,
            'likes' => $likes
        ]);
    }

    public function filters(Request $request)
    { }
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

    public function photoLikePhoto(Request $request) {
        // collect data from POST
        $photo_id = $request['photoId'];
        $is_like = $request['isLiked'] === 'true';
        $update = false;
        $photo = Photo::find($photo_id);
        // check if photo exists
        if (!$photo) {
            return null;
        }
        // check if user has already liked photo
        $user = Auth::user();
        $like = $user->likes()->where('photo_id' , $photo_id)->first();
        // if yes, remove the like from the table
        if ($like) {
            $already_like = $like->islike;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        // if not already liked, create a new like
        } else {
            $like = new Like();
        }
        // make $like parameters equal to the values retrieved from POST
        $like->islike = $is_like;
        $like->user_id = $user->user_id;
        $like->photo_id = $photo_id;
        // if like already exists, update, if not create new
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;

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
