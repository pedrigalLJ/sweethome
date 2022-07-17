<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChMessage as Message;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyMorePhotos;

class PropertyMorePhotosController extends Controller
{
    public function addMorePhotos($property_id)
    {
        $listing = Property::find($property_id);
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
        $images = PropertyMorePhotos::all()->where('property_id', $property_id);

        return view('dashboards.agent.property-add-more-photos', compact('msg', 'listing', 'images'));
    }

    public function store(Request $request)
    {
       $request->validate([
            'photos' => 'required',
                'photos.*' => 'mimes:jpg,png,jpeg|max:5048'
            ],
            [
                'photos.*.mimes' => 'Files must be in any type only: JPG, PNG, JPEG.',
                'photos.*max' => 'File must have a size of 5048KB.'
            ]);
           

        if($request->hasfile('photos'))
        {
            foreach($request->file('photos') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(public_path('storage/properties'), $name);
                $photoData[] = $name;
            }
        }

        PropertyMorePhotos::create([
            'url'           => json_encode($photoData),
            'property_id'   => $request->input('property_id'),
        ]); 

        return redirect()->back()->withMessage('Photos uploaded successfully.');
    }
}
