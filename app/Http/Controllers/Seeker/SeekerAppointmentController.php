<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\ChMessage as Message;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SeekerAppointmentController extends Controller
{
    public function appointments()
    {
        $waitings = Appointment::where('user_id', Auth::user()->id)
            ->where('status', 'Waiting')
            ->paginate(5);

        $approves = Appointment::where('user_id', Auth::user()->id)
            ->where('status', 'Approved')
            ->paginate(5);

        $declines = Appointment::where('user_id', Auth::user()->id)
            ->where('status', 'Declined')
            ->paginate(5);

        $histories = Appointment::where('user_id', Auth::user()->id)
            ->whereIn('status', ['Done', 'Cancelled'])
            ->paginate(5);

        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());

        return view('dashboards.seeker.appointments', compact('waitings', 'approves', 'declines', 'histories', 'msg'));
    }

    public function request(Request $request)
    {
        $request->validate([
            'date' => 'required|after:tomorrow',
            'input_time' => 'required'
        ]);
        
        $user_id = auth()->user()->id;
        $agent_id = $request->input('agent_id');
        $property_id = $request->input('property_id');
        $dateToDay = Carbon::parse($request->input('date'))->format('l');
        $date =$request->input('date');
        $avail_days = array($request->input('day'));
        $input_time = $request->input('input_time');
        $agent_email = User::where('id', $request->input('agent_id'))->first();
       
        foreach($avail_days as $val)
        { 
            $dcode = json_decode($val, true);
            $d_d = in_array($dateToDay, $dcode);
        }
        
        if(!Appointment::where([ 'user_id' => $user_id, 'property_id' => $property_id, 'time' => $input_time])->exists() && $d_d == TRUE)
        {
            Appointment::create([
                'user_id' => $user_id,
                'agent_id' => $agent_id,
                'property_id' => $property_id,
                'date' => $date,
                'time' => $input_time
            ]);

            $data = array(
                'time' => $input_time,
                'date' => $date,
                'seeker' => auth()->user()->username,
                'from' => auth()->user()->email
            );
            Mail::to($agent_email->email)->send(new AppointmentRequest($data));
            return redirect()->back()->withMessage('Requested successfully. Wait for an agent approval through email.');
        }
        elseif(Appointment::where('agent_id', $agent_id)->where('user_id', $user_id)->where('property_id', $property_id)->where('status', 'Declined')->first())
        {
            $appointment_id = Appointment::where('agent_id', $agent_id)->where('user_id', $user_id)->where('property_id', $property_id)->first();
            $appointment_id->status = 'Waiting';
            $appointment_id->save();
           
            $data = array(
                'time' => $input_time,
                'date' => $date,
                'seeker' => auth()->user()->username,
                'from' => auth()->user()->email
            );
            Mail::to($agent_email->email)->send(new AppointmentRequest($data));
            return redirect()->back()->withMessage('Rescheduling your appointment successfully. Wait for an agent approval through email.');
        }
        elseif($d_d == FALSE)
        {
            return redirect()->back()->withWarning('Day unavailable. Please make sure you follows the availability given.');
        }
        else
        {
            return redirect()->back()->withExist('You already set an appointment request.');
        }
    }

    public function done($id)
    {
        $appointment_id = Appointment::where('id', $id)->first();
        $appointment_id->status = 'Done';
        $appointment_id->save();

        return redirect()->route('seeker.appointments')
            ->withDone('Appointment Completed.');
    }

    public function cancel($id)
    {
        $appointment_id = Appointment::where('id', $id)->first();
        $appointment_id->delete();

        return redirect()->route('seeker.appointments')
            ->withCancel('Appointment Cancelled.');
    }
}