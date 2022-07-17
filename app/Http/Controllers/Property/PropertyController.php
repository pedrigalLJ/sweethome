<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\ChMessage as Message;
use App\Models\PropertyMorePhotos;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->search;
        
        $listings = Property::orderBy('id', 'desc')
            ->where('agent_id', Auth::id())
            ->where('status', 1)
            ->when($title, function ($query, $title) {
                return $query->where('title', 'LIKE', '%' .$title. '%');
            })
            ->paginate(5);
       
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
        
        $images = PropertyMorePhotos::all();
         
        return view('dashboards.agent.properties', compact('listings', 'msg', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
        return view('dashboards.agent.property-create', compact('msg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|max:100|unique:properties,title',
            'category'          => 'required',
            'type'              => 'required',
            'bathroom'          => 'required',
            'bedroom'           => 'required',
            'street_brgy'       => 'required|string|max:100',
            'city'              => 'required|string|regex:/^[a-zA-Z\s]+$/u|max:100',
            'province'          => 'required|string|regex:/^[a-zA-Z\s]+$/u|max:100',
            'featured_image'    => 'required|mimes:jpg,png,jpeg|max:5048',
            'price'             => 'required|regex:/^[1-9]\d*(\.\d+)?$/|min:1',
            'description'       => 'required',
            'avail_days'        => 'required',
            'avail_times'       => 'required',
            
            
        ],[
            'avail_times.required'  => 'Please provide time/s for property on site viewing.',
            'avail_days.required'  => 'Please provide days for property on site viewing.',
            'price.min' => 'Price not accepting negative numbers.'
        ]);
        
        $image_name = time().'-'. $request->title.'.'.$request->featured_image->extension();
        $request->featured_image->move(public_path('storage/properties'), $image_name);
        $days_comma_separated = json_encode($request->input('avail_days'));
        $times_comma_separated = json_encode($request->input('avail_times'));
        Property::create([
            'agent_id'          => auth()->user()->id,
            'title'             => $request->input('title'),
            'category'          => $request->input('category'),
            'type'              => $request->input('type'),
            'bathroom'          => $request->input('bathroom'),
            'bedroom'           => $request->input('bedroom'),
            'street_brgy'       => $request->input('street_brgy'),
            'city'              => $request->input('city'),
            'province'          => $request->input('province'),
            'featured_image'    => $image_name,
            'price'             => $request->input('price'),
            'description'       => $request->input('description'),
            'avail_days'        => $days_comma_separated,
            'avail_times'       => $times_comma_separated,
        ]);

        return redirect()->route('agent.properties.index')->withMessage('Property added successfully.');
    
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
        $listings = Property::find($id);
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());

        return view('dashboards.agent.property-edit', compact('listings', 'msg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'title'             => 'required|max:100|unique:properties,title, ' .$property->id,
            'category'          => 'required',
            'type'              => 'required',
            'bathroom'          => 'required',
            'bedroom'           => 'required',
            'street_brgy'       => 'required|string|max:100',
            'city'              => 'required|string|regex:/^[a-zA-Z\s]+$/u|max:100',
            'province'          => 'required|string|regex:/^[a-zA-Z\s]+$/u|max:100',
            'featured_image'    => 'mimes:jpg,png,jpeg|max:5048',
            'price'             => 'required|regex:/^[1-9]\d*(\.\d+)?$/|min:1',
            'status'            => 'required',
            'description'       => 'required',
            'url'               => 'mimes:jpg,png,jpeg|max:5048',
            
        ],[
            'price.min' => 'Price not accepting negative numbers.'
        ]);
       
        if($input = $request->input('avail_days') == '')
        {
           unset($input['avail_days']);
        }
        else
        {
            $input = json_encode($request->input('avail_days'));
        }
        if($input = $request->input('avail_times') == '')
        {
           unset($input['avail_times']);
        }
        else
        {
            $input = json_encode($request->input('avail_times'));
        }
        $input = $request->all();
        
        if($image = $request->file('featured_image'))
        {
            $path = 'storage/properties/';
            $new = date('YmdHis'). "." .$image->getClientOriginalExtension();
            $image->move($path, $new);
            $input['featured_image'] = "$new";
        }
        else
        {
            unset($input['featured_image']);
        }
        
       
        $property->update($input);


        return redirect()->route('agent.properties.edit', $property->id)->withMessage('Updated successfully.');
        
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
