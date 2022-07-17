<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use App\Models\User;
use App\Models\ChMessage as Message;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    public function index()
    {
        $listings = Property::all()
            ->where('agent_id', Auth::id())
            ->where('status', 1); 
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
        $appointments = Appointment::all()
            ->where('status', '=', 'Approved')
            ->where('agent_id', Auth::user()->id);
        $notAvailable = Property::all()
            ->where('status', 0)
            ->where('agent_id', Auth::id());
        $rented = Property::all()->where('status', 3)
            ->where('type', 'rent')
            ->where('agent_id', Auth::id());
        $sold = Property::all()->where('status', 2)
            ->where('type', 'sale')
            ->where('agent_id', Auth::id());
        $sales = Property::where('agent_id', Auth::id())
            ->where('status', 2)
            ->sum('price');
        $settingAppointment = Appointment::all()
            ->where('status', 1)
            ->where('agent_id', Auth::id());
        $needApproval = Appointment::all()
            ->where('status', 'Waiting')
            ->where('agent_id', Auth::id());

        return view('dashboards.agent.index', compact('sales', 'sold', 'rented','listings', 'needApproval', 'msg', 'appointments', 'settingAppointment', 'notAvailable'));
    }

    public function notAvailable(Request $request)
    {
        $title = $request->search;
        $listings = Property::orderBy('id', 'desc')
        ->where('agent_id', Auth::id())
        ->where('status', 0)
        ->when($title, function ($query, $title) {
            return $query->where('title', 'LIKE', '%' .$title. '%');
        })
        ->paginate(5);
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
        return view('dashboards.agent.properties-not-available', compact('listings', 'msg'));
    }
    
    public function profile()
    {
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
            
        return view('dashboards.agent.profile', compact('msg'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'given_name'    => ['required','string','regex:/^[a-zA-Z\s]+$/u','max:255'],
            'last_name'     => ['required','string','regex:/^[a-zA-Z\s]+$/u','max:255'],
            'city'          => ['required','string','regex:/^[- ,\/0-9a-zA-Z]+/'],
            'province'      => ['required','string','regex:/^[- ,\/0-9a-zA-Z]+/'],
            'phone_no'      => ['required','string','regex:/^(09|\+639)\d{9}$/'],
            'image'         => ['mimes:jpg,png,jpeg','max:5048'],
            'email'         => 'required|email|unique:users,email,'.Auth::user()->id,
            'username'      => 'required|string|min:4|unique:users,username,'.Auth::user()->id
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $path = 'storage/images/';
            $new_image_name = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($path, $new_image_name);
            $input['image'] = "$new_image_name";
        }else{
            unset($input['image']);
        }
        User::find(Auth::user()->id)->update($input);

        return redirect()->route('agent.profile')->withMessage('Your profile info has been updated successfuly.');
    }

    public function changePassword()
    {
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
            
        return view('dashboards.agent.change-password', compact('msg'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => ['required', new MatchOldPassword],
            'new_password'          => ['required', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,30}$/','min:8', 'max:30'],
            'confirm_new_password'  => ['same:new_password'],
        ],[
            'new_password.regex' => 'Password must have at least one of each type among lowercase, uppercase, and numbers between 8 and 30 characters.'
        ]);
        
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->route('agent.change-password')->withMessage('Your password has been changed successfully. Please try to re-login with update password.');
    }

    public function rateAndComments()
    {
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());

        $ratings = Rating::where('agent_id', Auth::id())
            ->paginate(5);
        $sum_of_ratings = Rating::where('agent_id', Auth::id())
            ->sum('star_rate');
        
        if($ratings->count() > 0)
        {
            $average_of_ratings = $sum_of_ratings/$ratings->count();
        }
        else
        {
            $average_of_ratings = 0;
        }
        return view('dashboards.agent.rate-and-comments', compact('msg', 'ratings', 'average_of_ratings'));
    }
}