<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentApprove;
use App\Mail\ReasonOfAppoinmentSeekerDecline;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\ChMessage as Message;
use Illuminate\Support\Facades\Mail;

class AgentAppointmentController extends Controller
{
    public function calendar()
    {
        
        $appointments = Appointment::with('user')
            ->where('agent_id', Auth::id())
            ->get();
        $msg = Message::all()
        ->where('seen', 0)
        ->where('from_id', '!=', Auth::id())
        ->where('to_id', Auth::id());

        return view('dashboards.agent.appointments', compact('msg', 'appointments'));
    }

    public function needApproval()
    {
       
        $appointments = Appointment::join('users', 'users.id', '=', 'appointments.user_id')
            ->join('properties', 'properties.id', '=', 'appointments.property_id')
            ->where('users.role_id', '=', '2')
            ->where('appointments.status', '=', 'Waiting')
            ->where('appointments.agent_id', Auth::id())
            ->paginate(5);
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());

        return view('dashboards.agent.appointments-need-approval', compact('appointments', 'msg'));
    }

    public function view($id)
    {
        $appointment = Appointment::find($id);
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());

        return view('dashboards.agent.appointment-view', compact('msg', 'appointment'));
    }

    public function approve(Request $request)
    {
        // ddd($request->all());
        $appointment_id = Appointment::where('agent_id', Auth::id())->where('user_id', $request->input('user_id'))->where('property_id', $request->input('property_id'))->first();
        $appointment_id->status = 'Approved';
        $appointment_id->save();

        $data = array(
            'date' => $appointment_id->date,
            'time' => $appointment_id->time,
            'from'  => auth()->user()->email,
            'street_brgy' => $appointment_id->property->street_brgy,
            'city' => $appointment_id->property->city,
            'province' => $appointment_id->property->province
        );
        Mail::to($appointment_id->user->email)->send(new AppointmentApprove($data));

        return redirect()->route('agent.appointments-need-approval')
            ->withApprove('Appointment approved successfully');
    }

    public function decline(Request $request)
    {
        $this->validate($request,[
            'reason' => 'required'
        ],
        [
            'reason.required' => 'Kindly state your reason upon declining this appointment.'
        ]);
        
        $appointment_id = Appointment::where('agent_id', Auth::id())->where('user_id', $request->input('user_id'))->where('property_id', $request->input('property_id'))->first();
        $appointment_id->status = 'Declined';
        $appointment_id->save();

        $data = array(
            'reason' => $request->reason,
            'from'  => auth()->user()->email
        );

        Mail::to($appointment_id->user->email)->send(new ReasonOfAppoinmentSeekerDecline($data));

        return redirect()->route('agent.appointments-need-approval')
            ->withDecline('Appointment declined.');
    }
}
