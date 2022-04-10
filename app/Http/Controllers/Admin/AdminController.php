<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserApproveMail;
use App\Mail\UserDeclineMail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy("created_at", "desc");
            
        $needApprovalUsers = User::where('status', 2)
            ->orderBy("created_at", "desc")
            ->get();

        $approvedUsers = User::where('status', 1)
            ->orderBy("created_at", "desc")
            ->get();

        $declinedUsers = User::where('status', 0)
            ->orderBy("created_at", "desc")
            ->get();

        $seekerUsers = User::where('role_id', 2)
            ->orderBy("created_at", "desc")
            ->get(); 

        $agentUsers = User::where('role_id', 1)
            ->orderBy("created_at", "desc")
            ->get();
        
        $notifications = auth()->user()->unreadNotifications;

        $monthlyAgentUser = [
            'chart_title' => 'Agents Every Month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'where_raw' => 'role_id = 1 AND status = 1',
            'chart_color' => '254, 57, 57'
        ];
        $monthlyAgentUserChart = new LaravelChart($monthlyAgentUser);
        
        $monthlySeekerUser = [
            'chart_title' => 'Seekers Every Month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'where_raw' => 'role_id = 2 AND status = 1',
            'chart_color' => '176, 81, 81'
        ];
        $monthlySeekerUserChart = new LaravelChart($monthlySeekerUser);

        return view('dashboards.admin.index', compact('users', 'needApprovalUsers', 'approvedUsers', 'declinedUsers','notifications','seekerUsers','agentUsers', 'monthlyAgentUserChart', 'monthlySeekerUserChart'));
    }

    public function login()
    {
        return view('dashboards.admin.login');
    }

    public function check(Request $request)
    {
        //Validate Inputs
        $request->validate([
           'username'=>'required|exists:admins,username',
           'password'=>'required|min:8|max:30'
        ],[
            'username.exists'=>'This username is not exists in our records.'
        ]);


        $creds = $request->only('username','password');
        

        if( Auth::guard('admin')->attempt($creds) ){
            return redirect()->route('admin.dashboard');
        }else{
            return view('dashboards.admin.login')->withMessage('fail','Incorrect credentials');
        }
    }

    public function logout()
    {
       Auth::guard('admin')->logout();
       return redirect()->route('admin.login');
    }

    public function approve($user_id)
    {
        $user_id = User::find($user_id);
        $user_id->status = 1;
        $user_id->save();

        $data = [
            'given_name' => $user_id->given_name,
            'last_name' => $user_id->last_name
        ];

       Mail::to($user_id->email)->send(new UserApproveMail($data));
        return redirect()->route('admin.need-approval')
            ->withMessage('User approved successfully');
    }
    public function decline($user_id)
    {
        $user_id = User::find($user_id);
        $user_id->status = 0;
        $user_id->save();

        $data = [
            'given_name' => $user_id->given_name,
            'last_name' => $user_id->last_name
        ];

       Mail::to($user_id->email)->send(new UserDeclineMail($data));
        return redirect()->route('admin.need-approval')
            ->withMessage('User declined successfully');
    }

    public function needApproval(Request $request)
    {
        $role_username = $request->search;
        
        $agents = User::where('status', 2)
            ->when($role_username, function ($query, $role_username) {
                return $query->where('username', 'LIKE', '%'. $role_username .'%');
            })
            ->where('role_id', 1)
            ->orderBy("created_at", "desc")
            ->paginate(10, ['*'], 'agents');
            
        $seekers = User::where('status', 2)
            ->when($role_username, function ($query, $role_username) {
                return $query->where('username', 'LIKE', '%'. $role_username .'%');
            })
            ->where('role_id', 2)
            ->orderBy("created_at", "desc")
            ->paginate(10, ['*'], 'seekers');
        
        $notifications = auth()->user()->unreadNotifications;

        return view('dashboards.admin.need-approval', compact('agents','seekers', 'notifications'));
    }
    public function userLists(Request $request)
    {
        $role_username = $request->search;
        
        $agents = User::where('status', 1)
            ->when($role_username, function ($query, $role_username) {
                return $query->where('username', 'LIKE', '%'. $role_username .'%');
            })
            ->where('role_id', 1)
            ->orderBy("created_at", "desc")
            ->paginate(10, ['*'], 'seekers');
            
        $seekers = User::where('role_id', 2)
            ->when($role_username, function ($query, $role_username) {
                return $query->where('username', 'LIKE', '%'. $role_username .'%');
            })
            ->where('status', 1)
            ->orderBy("created_at", "desc")
            ->paginate(10, ['*'], 'agents');
        $notifications = auth()->user()->unreadNotifications;

        

        return view('dashboards.admin.user-lists-approved', compact('agents', 'seekers', 'notifications'));
    }

    public function userListsDeclined(Request $request)
    {
        $role_username = $request->search;
        $agents = User::where('status', 0)
            ->when($role_username, function ($query, $role_username) {
                return $query->where('username', 'LIKE', '%'. $role_username .'%');
            })
            ->where('role_id', 1)
            ->orderBy("created_at", "desc")
            ->paginate(10, ['*'], 'seekers');
            
        $seekers = User::where('role_id', 2)
            ->when($role_username, function ($query, $role_username) {
                return $query->where('username', 'LIKE', '%'. $role_username .'%');
            })
            ->where('status', 0)
            ->orderBy("created_at", "desc")
            ->paginate(10, ['*'], 'agents');
        $notifications = auth()->user()->unreadNotifications;

        return view('dashboards.admin.user-lists-declined', compact('agents', 'seekers', 'notifications'));
    }


    public function profile()
    {
        $profile = Auth::guard('admin');
        $notifications = auth()->user()->unreadNotifications;

        return view('dashboards.admin.profile', compact('profile', 'notifications'));
    }

    public function notifications()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('dashboards.admin.notifications', compact('notifications'));
    }
    public function markNotifs(Request $request)
    {
        auth()->user()->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) 
            {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}
