<?php

namespace App\Http\Controllers;

use App\Events\VoteEvent;
use App\Models\Country;
use App\Models\Vote;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{

    public function index()
    {


        $counties = Country::all();
        $votes = Vote::with('country') // Eager load the country relation
        ->get()
            ->groupBy('country_id') // Group by country_id
            ->map(function ($votes) {
                // Get the country name
                $country = $votes->first()->country; // Assuming 'name' is the column for country name

                // Return the country name and vote count
                return [
                    'country' => $country,
                    'vote_count' => $votes->count(),
                ];
            })
            ->values();

        $counts = Vote::all()->count();

        return view('index',['countries'=>$counties,'votes'=>$votes , 'counts'=>$counts]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'fullname' => 'required',
             'country' => 'required|exists:geo_countries,id',


        ]);

        $device_hash = md5($request->ip() . $request->header('User-Agent'));
      if (Vote::where('device_hash', $device_hash)->exists()) {
            return response()->json(['message' => 'You have already voted.'], 403);
        }

        $vote = new Vote();
        $vote->email = $request->email;
        $vote->fullname = $request->fullname;
        $vote->ip_address = $request->ip();
        $vote->user_agent = $request->header('User-Agent');
        $vote->device_hash = $device_hash;
        $vote->country_id = $request->country;

        $vote->save();

        return response()->json(['message' => 'Vote cast successfully.']);
    }



    public function castVote()
    {

        // Fetch updated vote counts
        $votes = Vote::all()->groupBy('country')->map->count();

        // Broadcast the updated votes
        broadcast(new VoteEvent($votes));

        return response()->json(['message' => 'Vote cast successfully.']);
    }
}
