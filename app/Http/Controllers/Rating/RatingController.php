<?php

namespace App\Http\Controllers\Rating;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        $agent_id = $request->input('agent_id');
        $rated_star = $request->input('rate_star');
        $done_rating = Rating::where('user_id', Auth::id())->where('agent_id', $agent_id)->first();

        if($done_rating)
        {
            $done_rating->star_rate = $rated_star;
            $done_rating->comment = $request->input('comment');
            $done_rating->update();

            return redirect()->back()->withMessage('Rating updated successfully.');
            
        }
        else
        {
            Rating::create([
                'user_id' =>  Auth::id(),
                'agent_id' => $agent_id,
                'star_rate' => $rated_star,
                'comment' => $request->input('comment'),
            ]);

            return redirect()->back()->withMessage('Thank you for rating this agent.');
        }

    }
}
