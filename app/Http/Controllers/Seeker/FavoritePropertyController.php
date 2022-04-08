<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoriteProperty;
use App\Models\ChMessage as Message;
use Illuminate\Support\Facades\Auth;

class FavoritePropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToFavorites($property_id)
    {
        $this->user_id = auth()->user()->id;

        if(!FavoriteProperty::where(['property_id'=>$property_id, 'user_id'=>$this->user_id])->exists())
        {
            FavoriteProperty::create(['property_id'=>$property_id, 'user_id'=>$this->user_id]);
        }
        return redirect()->route('seeker.view-property', $property_id)->withMessage('Added To Favorites.');
    }

    public function viewFavorites()
    {
        $favorites = FavoriteProperty::where('user_id', Auth::id())->get();
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());

        return view('dashboards.seeker.favorites', compact('favorites', 'msg'));
    }

    public function removeToFavorites($id)
    {
        $favorite = FavoriteProperty::findOrFail($id);
        $favorite->delete();

        return redirect()->route('seeker.my-favorites')->withRemoved('Removed To Favorites');
      
    }
}
